<?php

function generateAPI(array $options = array())
{
    $defaults = array(
        'status'   => true,
        'message'    => '',
        'code'  => 200,
        'data'  => null,
    );
    $options = array_merge($defaults, $options);
    extract($options);
    
    if(is_array($data)) $lenght = count($data);
    else if(is_bool($data)) $data ? $lenght = 1 : $lenght = 0;
    else if(is_string($data)) $data == '' ? $lenght = 0 : $lenght = 1;
    else if(is_integer($data)) $data != 0 ? $lenght = 1 : $lenght = 0;
    else $lenght = 0;
    
    return response()->json([
        'status' => $status,
        'code' => $code,
        'message' => $message,
        'data' => $data,
        'lenght' => $lenght
    ], $code);
}

function generateAPIMessage(array $options = array(), $status = true)
{
    $defaults = array(
        'context' => null,
        'type' => 'read',
        'id' => null,
    );
    $options = array_merge($defaults, $options);
    extract($options);

    switch($type){
        case 'create':
            return $status ? "Ambil data $context berhasil." : "Ambil data $context gagal.";
        case 'read':
            return $status ? "Tambah data $context berhasil." : "Tambah data $context gagal.";
        case 'update':
            return $status ? "Update data $context id $id berhasil." : "Data $context dengan id $id tidak ditemukan.";
        case 'find' :
            return $status ? "Ambil data $context dengan id $id berhasil." : "Data $context dengan id $id tidak ditemukan.";
        case 'delete':
            return $status ? "Hapus data $context dengan id $id berhasil." : "Data $context dengan id $id tidak ditemukan.";
    }
    
}