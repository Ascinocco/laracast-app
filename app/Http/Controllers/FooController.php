<?php

namespace App\Http\Controllers;

use App\Repositories\FooRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FooController extends Controller
{
    private $repository;
    //here we are showing constructor injection
    //the parameters are the injects
    //we are type hinting a FooRepository object instead
    //of instantiating a new class within the constructor
    //but how does this run if we don't explicitly pass in
    // a FooRepository object???????
    //I think this has to do with the nature of dependency injection...
    //UPDATE: IT GETS THE OBJECT FROM ITS IOC/SERVICE CONTAINER!!!!!
    //ALSO YOU CAN DO THE EXACT SAME THING FOR METHODS JUST PROVIDE
    //THE METHOD WITH THE PROPER PARAMETERS SUCH AS THE ONES BELOW
    //THE USE CASE FOR METHOD INJECTION WOULD BE IF ONLY ONE METHOD NEEDS
    //A PARTICULAR DEPENDENCY. IF MORE THAN ONE USE CONSTRUCTOR INJECTION
    public function __constructor(FooRepository $repository)
    {
        $this->repository = $repository;
    }

    public function foo()
    {
        //since we store a FooRepository object in the private
        //repository variable we can reference the methods
        //of that variable(object) to 'get' data
        return $this->repository->get();
    }
}
