<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-02 18:30
 */

namespace App\Http\Controllers;


class HomeController extends Controller
{
    /**
     * This is the index for and other
     *
     */
    public function index() {
        return view('welcome');
    }
}