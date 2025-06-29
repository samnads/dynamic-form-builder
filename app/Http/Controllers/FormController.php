<?php

namespace App\Http\Controllers;

use App\Events\FormCreated;
use App\Models\FieldType;
use App\Models\Form;
use App\Models\FormField;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class FormController extends Controller
{
    public function createForm()
    {
        $data['field_types'] = FieldType::all();
        return view('forms.create-form', $data);
    }

    public function editForm($id)
    {
        $data['form'] = Form::where('id', $id)->with(['fields'])->first();
        $data['field_types'] = FieldType::all();
        return view('forms.edit-form', $data);
    }

    public function listForms(Request $request)
    {
        return view('forms.list-forms');
    }

    public function datatable(Request $request)
    {
        $data = Form::latest();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('url', function ($row) {
                return '<a href="' . url('form/' . $row->id) . '" target="_blank">' . url('form/' . $row->id) . '</a>';
            })
            ->addColumn('actions', function ($row) {
                return '<a title="Edit Form" href="' . route('forms.edit', ['id' => $row->id]) . '" class="btn btn-primary btn-sm mt-1">Edit</a>';
            })
            ->rawColumns(['url', 'actions'])
            ->make(true);
    }

    public function submissionsList(Request $request)
    {
        return view('forms.list-submissions');
    }

    public function submissionsListDatatable(Request $request)
    {
        $data = FormSubmission::with(['form'])->latest();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('submitted_data', function ($submission) {
                $html = '<table class="table table-sm table-success table-striped">';
                foreach ($submission->data as $entry) {
                    $label = $entry->field->label ?? 'N/A';
                    $value = $entry->value;
                    $html .= "<tr><th>{$label}</th><td>{$value}</td></tr>";
                }
                $html .= '</table>';
                return $html;
            })
            ->rawColumns(['submitted_data'])
            ->make(true);
    }

    public function save(Request $request)
    {
        try {
            DB::beginTransaction();
            $form = Form::create(['title' => $request->title]);
            foreach ($request->fields as $key => $column) {
                FormField::create([
                    'form_id' => $form->id,
                    'field_type_id' => $column['field_type'],
                    'label' => $column['label'],
                    'data' => json_encode(explode(',', @$column['data']))
                ]);
            }
            DB::commit();
            event(new FormCreated($form));
            return response()->json([
                'success' => true,
                'message' => 'Form saved successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occured.'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $form = Form::find($id);
            $form->title = $request->title;
            $form->save();
            $ids = [];
            foreach ($request->fields as $key => $column) {
                if ($column['id']) {
                    FormField::where('id', $column['id'])->update([
                        'field_type_id' => $column['field_type'],
                        'label' => $column['label'],
                        'data' => json_encode(explode(',', @$column['data']))
                    ]);
                    $ids[] = $column['id'];
                } else {
                    $form_field = FormField::create([
                        'form_id' => $form->id,
                        'field_type_id' => $column['field_type'],
                        'label' => $column['label'],
                        'data' => json_encode(explode(',', @$column['data']))
                    ]);
                    $ids[] = $form_field['id'];
                }
            }
            FormField::where('form_id', $form->id)->whereNotIn('id', $ids)->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Form updated successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occured.'
            ]);
        }
    }
}
