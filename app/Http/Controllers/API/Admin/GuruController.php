<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Guru as GuruModel;
use App\Models\User as UserModel;
use App\Http\Resources\GuruCollection as GuruRes;

class GuruController extends Controller
{
    private static $context = 'Guru';

    function __construct()
    {
        $this->middleware(['auth:api', 'rolecheck:admin']);
    }

    private function term($request, $id = null)
    {
        /**
         * Username need user id to check unique
         * It places on guru table on data_of column
         * $userid variable contain data_of
         * 
         * @return null when $id is null
         * @return data_of
         */
        $userId = isset($id) ? GuruModel::find($id)->data_of : null;

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
            'sex' => 'required|in:m,f',
            'whatsapp' => 'required|max:15|unique:guru,whatsapp,'.$id.',id',
            'address' => 'required',
            'birth_date' => 'required|date'
        ]);
        return $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gurus = GuruRes::collection(GuruModel::with(['user', 'mapels'])->get());
        return generateAPI(['data' => $gurus, 'custom_lenght' => count($gurus), 'message' => generateAPIMessage(['context' => Self::$context, 'type' => 'read'])]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->term($request);
        if($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $userModel = new UserModel;
        $userModel->username = $request->username;
        $userModel->password = bcrypt($request->password);
        $userModel->foto_profil = 'default.jpg';
        $userModel->role = 'guru';
        $userModel->save();

        $guruModel = new GuruModel;
        $guruModel->data_of = $userModel->id;
        $guruModel->NIP = $request->nip;
        $guruModel->nama = $request->name;
        $guruModel->jk = $request->sex == 'm' ? 'l' : 'p';
        $guruModel->whatsapp = $request->whatsapp;
        $guruModel->alamat = $request->address;
        $guruModel->tanggal_lahir = $request->birth_date;
        $guruModel->save();

        $dataGuru = GuruRes::make(GuruModel::find($guruModel->id));
        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'create']), 'data' => $dataGuru]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = intval(preg_replace('/[\D]/', '', $id)) ?: null;

        $guruModel = GuruModel::with(['user', 'mapels'])->find($id);
        if(!isset($guruModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'find', 'id' => $id], false)]);

        $guruData = GuruRes::make($guruModel);
        return generateAPI(['data' => $guruData, 'message' => generateAPIMessage(['context' => Self::$context, 'type' => 'find', 'id' => $id])]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = intval(preg_replace('/[\D]/', '', $id)) ?: null;

        $validator = $this->term($request, $id);
        if($validator->fails()) return generateAPI(['data' => $validator->messages()->toArray(), 'message' => 'Validation Error', 'code' => 403, 'status' => false]);

        $guruModel = GuruModel::find($id);
        if(!isset($guruModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'update', 'id' => $id], false)]);

        $guruModel->user->username = $request->username;
        $guruModel->user->password = $request->password;
        $guruModel->user->foto_profil = $request->profile_pict ?? $guruModel->user->foto_profil;

        $guruModel->NIP = $request->nip;
        $guruModel->nama = $request->name;
        $guruModel->jk = $request->sex == 'm' ? 'l' : 'p';
        $guruModel->whatsapp = $request->whatsapp;
        $guruModel->alamat = $request->address;
        $guruModel->tanggal_lahir = $request->birth_date;
        $guruModel->user->save();
        $guruModel->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = intval(preg_replace('/[\D]/', '', $id)) ?: null;

        $guruModel = GuruModel::find($id);
        if(!isset($guruModel)) return generateAPI(['status' => false, 'code' => 404, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'update', 'id' => $id], false)]);

        $guruModel->user->delete();
        $guruModel->delete();
        return generateAPI(['status' => true, 'message' => generateAPIMessage(['context' => self::$context, 'type' => 'delete', 'id' => $id])]);
    }
}
