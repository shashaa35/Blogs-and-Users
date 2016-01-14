<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\FooRepository;
use Illuminate\Http\Request;

class FooController extends Controller {
//    /**
//     * @var FooRepository
//     */
//    private $repo;
//    /**
//     * @param FooRepository $repo
//     */
//    public function __construct(FooRepository $repository)
//    {
//        $this->repo = $repository;
//    }
//    /**
//     * @return mixed
//     */
    public function foo(FooRepository $repo){
        return $repo->get();
    }
}
