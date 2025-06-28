<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormData;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicFormController extends Controller
{
    public function viewForm(Request $request, $id)
    {
        $data['form'] = Form::with('fields')->where('id', $id)->first();
        return view('forms.public-form', $data);
    }

    public function save(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $FormSubmission = FormSubmission::create(['form_id' => $id]);
            foreach ($request->names as $form_field_id => $value) {
                FormData::create([
                    'form_submission_id' => $FormSubmission->id,
                    'form_field_id' => $form_field_id,
                    'value' => $value
                ]);
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Form submitted successfully.'
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
