<?php

/*
 * This is simple restful API.
 * Designed by Stanimir Georgiev
 * Use it without any limitations.
 */

namespace RestAPI\Interfaces;

/**
 *
 * @author Stanimir Georgiev
 */

interface RouterInterface {

    public function getURI();

    public function getPost();
}
