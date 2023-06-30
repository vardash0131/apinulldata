<?php namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;
use App\Models\Employes;
use App\Models\EmployesSkills;
use DB;
use Carbon\Carbon;
class EmployesController extends Controller
{

    public function register(Request $request)
    {

        $data      = $request->all();
        $validator = Validator::make($data, [
            'email' => 'required|email|max:255|unique:App\Models\Employes,email',
            'name'   => 'required|string|max:255',
            'position'   => 'required|string|max:255',
            'birth_date'   => 'required|date_format:d/m/Y',
            'address' => 'required|string|max:255',
            'skill'  => 'required',
            'skill.*.skill' => 'required|string|max:255|',
            'skill.*.qualification' => 'required|string|max:5'

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['status' => 'false', 'error' => $errors,"data"=>[]], 400);
        }

        $newEmploye = new Employes;

        $newEmploye->name = $request->name;
        $newEmploye->email = $request->email;
        $newEmploye->position = $request->position;
        $newEmploye->birth_date = Carbon::createFromFormat('d/m/Y', $request->birth_date);;
        $newEmploye->address = $request->address;
        $skills = [];
        foreach ($request->skill as $key => $value) {

            $skill = new EmployesSkills;
            $skill->name = $value["skill"];
            $skill->rating =  $value["qualification"];
            $skills[] = $skill;
        }

        DB::transaction(function() use ($newEmploye, $skills) {
           $newEmploye->save();

           foreach ($skills as $key => $value) {
               Employes::find($newEmploye->id)->skills()->save($value);
           }

        });
        return response()->json(['status' => 'true', 'error' => [],'data'=>$newEmploye], 200);

    }

public function get($email)
    {

        $data      = ['email'=>$email];
        $validator = Validator::make($data, [
            'email' => 'required|email|max:255|exists:App\Models\Employes,email'

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['status' => 'false', 'error' => $errors,"data"=>[]], 400);
        }

        $employe = Employes::where('email',$email)->with("skills")->first();
        return response()->json(['status' => 'true', 'error' => [],'data'=>$employe], 200);

    }

}
