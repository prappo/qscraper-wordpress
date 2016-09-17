<?php
namespace MyPlugin\Controllers;

use MyPlugin\Models\Data;

class DashboardController
{
    /**
     * @return string
     */
    public function index()
    {
        if (wp_get_current_user()->roles[0] == "administrator" || wp_get_current_user()->roles[0] == "quser") {

            $mailCount = 0;
            $phoneCount = 0;
            $userCount = 0;
            $user = wp_get_current_user()->user_login;
            if (wp_get_current_user()->roles[0] == "administrator") {
                $tdata = Data::all()->count();
                $isAdmin = true;
            } else {
                $tdata = Data::where('user', wp_get_current_user()->user_login)->count();
                $isAdmin = false;
            }
            /* count email by user */
            if (wp_get_current_user()->roles[0] == "administrator") {
                foreach (Data::all() as $data) {
                    if ($data->email == "") {
                        $mailCount++;
                    }
                }
                $temail = Data::all()->count() - $mailCount;
            } else {
                foreach (Data::where('user', $user)->get() as $data) {
                    if ($data->email == "") {
                        $mailCount++;
                    }
                }
                $temail = $mailCount;
            }
            /* count phone numbers by user*/
            if (wp_get_current_user()->roles[0] == "administrator") {
                foreach (Data::all() as $d) {
                    if ($d->phone == "") {
                        $phoneCount++;
                    }
                }
                $tphone = Data::all()->count() - $phoneCount;
            } else {
                foreach (Data::where('user', $user) as $d) {
                    if ($d->phone == "") {
                        $phoneCount++;
                    }
                }
                $tphone = $phoneCount;
            }

            /*Count user*/

            foreach (get_users() as $users) {
                if ($users->roles[0] == "quser") {
                    $userCount++;
                }
            }


            return view('@MyPlugin/dashboard.twig', ['tdata' => $tdata, 'temail' => $temail, 'tphone' => $tphone, 'usercount' => $userCount, 'isAdmin' => $isAdmin, 'username' => $user]);
        } else {
            return "Your account is not activated . Please contact to admin";
        }


    }
}