<?php

use Sabo\Sabo\Route;


// routes à placer ici
return Route::generateFrom([
    Route::get("/admin", function (){ echo"Hello"; }, "Admin")
]);
