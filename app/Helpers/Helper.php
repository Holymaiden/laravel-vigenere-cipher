<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Session;

class Helper
{
    public static function title($value)
    {
        return Str::remove(' ', ucwords(Str::of($value)->replace('_', ' ')));
    }

    // get data icon
    public static function icon()
    {
        $data = [
            'flaticon-squares-1', 'flaticon-technology', 'flaticon-squares', 'flaticon-menu-1', 'flaticon-menu-2', 'flaticon-settings-1', 'flaticon-folder-1', 'flaticon-folder-2', 'flaticon-folder-3',
            'flaticon-users', 'flaticon-users-1',
        ];
        return $data;
    }

    // get head title tabel
    public static function head($param)
    {
        return ucwords(str_replace('-', ' ', $param));
    }

    // replace spasi
    public static function replace($param)
    {
        return str_replace(' ', '', $param);
    }

    // button create
    public static function btn_create($roles)
    {
        return '<a onclick="createForm()" class="">
                        <button class="btn btn-primary btn-rounded btn-sm">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Add New
                        </button>
                     </a>';
    }

    // get data from tabel
    public static function btn_action($id)
    {
        $edit = '<a onclick="editForm(' . $id . ')" class="">
                        <button type="button" class="btn btn-icon btn-round btn-warning btn-sm">
                            <i class="fa fa-pencil-alt"></i>
                        </button>
            </a> ';
        $delete = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $id . '"
               title="Delete" class="deleteData">
                        <button type="button" class="btn btn-icon btn-round btn-danger btn-sm">
                            <i class="fa fa-trash-alt"></i>
                        </button>
            </a>';
        return $edit . $delete;
    }

    // cek data menu role user
    public static function get_data($param)
    {
        $data = DB::table($param)->get();
        return isset($data) ? $data : null;
    }

    public static function arrayToString($param)
    {
        $data = null;
        foreach ($param as $v) {
            if ($data == null) {
                $data = $v;
            } else {
                $data = $data . "," . $v;
            }
        }
        return $data;
    }

    public static function getSetting($field)
    {
        $data = DB::table('settings')->first();
        return $data->$field ?? null;
    }

    public static function encrypt($text)
    {
        $key = Helper::getSetting('key');
        $pswd = strtolower($key);
        // intialize variables
        $ki = 0;$kl = strlen($pswd);$length = strlen($text);
        // iterate over each line in text
        for ($i = 0; $i < $length; $i++) {
            if (ctype_alpha($text[$i])) {
                // uppercase
                if (ctype_upper($text[$i])) {
                    $text[$i] = chr(((ord($pswd[$ki]) - ord("a") + ord($text[$i]) - ord("A")) % 26) + ord("A"));
                }
                // lowercase
                else {
                    $text[$i] = chr(((ord($pswd[$ki]) - ord("a") + ord($text[$i]) - ord("a")) % 26) + ord("a"));
                }
                $ki++;
                if ($ki >= $kl) {
                    $ki = 0;
                }
            }
        }
        // return the encrypted code
        return $text;
    }

    public static function decrypt($text)
    {
        $key = Helper::getSetting('key');
        // change key to lowercase for simplicity
        $pswd = strtolower($key);
        // intialize variables
        $ki = 0;$kl = strlen($pswd);$length = strlen($text);
        // iterate over each line in text
        for ($i = 0; $i < $length; $i++) {
            // if the letter is alpha, decrypt it
            if (ctype_alpha($text[$i])) {
                // uppercase
                if (ctype_upper($text[$i])) {
                    $x = (ord($text[$i]) - ord("A")) - (ord($pswd[$ki]) - ord("a"));
                    if ($x < 0) {
                        $x += 26;
                    }
                    $x = $x + ord("A");
                    $text[$i] = chr($x);
                }
                // lowercase
                else {
                    $x = (ord($text[$i]) - ord("a")) - (ord($pswd[$ki]) - ord("a"));
                    if ($x < 0) {
                        $x += 26;
                    }
                    $x = $x + ord("a");
                    $text[$i] = chr($x);
                }
                // update the index of key
                $ki++;
                if ($ki >= $kl) {
                    $ki = 0;
                }
            }
        }
        // return the decrypted text
        return $text;
    }
}
