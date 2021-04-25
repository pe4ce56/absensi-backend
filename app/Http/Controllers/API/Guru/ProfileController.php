<?php

namespace App\Http\Controllers\API\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

use App\Models\Guru as GuruModel;

use App\Http\Resources\GuruCollection as GuruRes;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'rolecheck:guru']);
    }

    private function term($request, $id)
    {
        /**
         * Username need user id to check unique
         * It places on guru table on data_of column
         * $userid variable contain data_of
         * 
         * @return null when $id is null
         * @return data_of
         */
        $userId = isset($id) ? (GuruModel::find($id)->data_of ?? null) : null;

        $validator = Validator::make($request->all(), [
            'username' => ['required','unique:user,username,'.$userId.',id', 
                    function ($attribute, $value, $fail) {
                        !preg_match('/[a-zA-Z]/', $value) ? $fail($attribute.' must contain at least one character') : null;
                    },
                    'min:5',
                ],
            'password' => 'required|min:3|max:255',
            'password_conf' => 'required|same:password',
            'profile_pict' => 'image',

            'nip' => 'required|digits:18|unique:guru,NIP,'.$id.',id',
            'name' => 'required|max:100',
            'gender' => 'required|in:m,f',
            'whatsapp' => 'required|max:15|unique:guru,whatsapp,'.$id.',id',
            'address' => 'required',
            'birth_date' => 'required|date'
        ]);
        return $validator;
    }

    public function getProfileDetails(Request $request, $id)
    {
        $id = intval(preg_replace('/[\D]/', '', $id)) ?: null;

        $guruModel = GuruModel::find($id);
        if(!isset($guruModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => 'profile guru', 'type' => 'find', 'id' => $id], false)]);

        $guruProfileDetails = GuruRes::make($guruModel);
        return generateAPI(['data' => $guruProfileDetails, 'message' => generateAPIMessage(['context' => 'profile guru', 'type' => 'find', 'id' => $id])]);
    }

    public function updateProfileDetails(Request $request, $id)
    {
        $id = intval(preg_replace('/[\D]/', '', $id)) ?: null;

        $validator = $this->term($request, $id);
        if($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $guruModel = GuruModel::find($id);
        if(!isset($guruModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => 'profile guru', 'type' => 'find', 'id' => $id], false)]);

        $guruModel->user->username = $request->username;
        $guruModel->user->password = bcrypt($request->password);
        $guruModel->user->foto_profil = $request->profile_pict ?? $guruModel->user->foto_profil;

        $guruModel->NIP = $request->nip;
        $guruModel->nama = $request->name;
        $guruModel->jk = $request->gender == 'm' ? 'l' : 'p';
        $guruModel->whatsapp = $request->whatsapp;
        $guruModel->alamat = $request->address;
        $guruModel->tanggal_lahir = $request->birth_date;
        $guruModel->user->save();
        $guruModel->save();

        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => 'edit profile guru', 'type' => 'update', 'id' => $id]), 'data' => $guruModel]);
    }
}
