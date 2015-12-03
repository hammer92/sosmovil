<?php

interface IController {
    
    function __construct($ruta);
    function  index();
    function create();
    function read($id);
    function update($id);
    function delete($id);
    
}
