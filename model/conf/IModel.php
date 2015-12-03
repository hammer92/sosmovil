<?php

interface IModel {
    function all();
    function find($id);
    function save();
    function delete($id);
    
    function select($select = NULL);
    function create($create = NULL);
    function insert($create = NULL);
    function update($update = NULL);
    function where ($where  = NULL);
    
    function toArray();
    function toJson();
    function exec();
    function query($sql);
    function sql();
            
    function between($col,$berween = array());
    function mand($mand = array());
    function mor($mor = array());
    function like($like = array());
    function groupBy($groupby = array());
    function orderBy($orderby = array());
    function count();
    function limit($limit = NULL);
            
    function innerJoin($tabla,$innerjoin = array());
    function leftJoin($tabla,$leftjoin = array());
    function rightJoin($tabla,$righjoin = array());
    
}
