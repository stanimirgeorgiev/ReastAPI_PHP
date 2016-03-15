<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

/**
 * Description of NewsController
 * NewsController should be responsible for managing request to news routes.
 * @author Asus
 */

namespace RestAPI\Controllers;

class NewsController extends \RestAPI\Exceptions\BaseController {
    
    private $request = null;

    public function __construct() {
        $this->request = parent::getRequester();
    }

    /**
     * @GET \news\
     * @Unauthorize
     * 
     * Gets all news that are free for public view
     */
    public function GetAllNews($model) {
        if (!$model->getIsValid()) {
            return $this->request->NotFound($model, "Received data in either missing or invalid");
        }
    }

}
