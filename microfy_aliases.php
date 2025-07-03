<?php

// microfy_aliases.php - v0.1.1

if (!function_exists('val')) {
    function val(...$args) {
        return Microfy::val(...$args);
    }
}
if (!function_exists('get')) {
    function get(...$args) {
        return Microfy::get(...$args);
    }
}
if (!function_exists('post')) {
    function post(...$args) {
        return Microfy::post(...$args);
    }
}
if (!function_exists('request')) {
    function request(...$args) {
        return Microfy::request(...$args);
    }
}
if (!function_exists('extractKeys')) {
    function extractKeys(...$args) {
        return Microfy::extractKeys(...$args);
    }
}
if (!function_exists('getVars')) {
    function getVars(...$args) {
        return Microfy::getVars(...$args);
    }
}
if (!function_exists('postVars')) {
    function postVars(...$args) {
        return Microfy::postVars(...$args);
    }
}
if (!function_exists('reqVars')) {
    function reqVars(...$args) {
        return Microfy::reqVars(...$args);
    }
}
if (!function_exists('getVarsWithPrefix')) {
    function getVarsWithPrefix(...$args) {
        return Microfy::getVarsWithPrefix(...$args);
    }
}
if (!function_exists('loadInputs')) {
    function loadInputs(...$args) {
        return Microfy::loadInputs(...$args);
    }
}
if (!function_exists('getAll')) {
    function getAll(...$args) {
        return Microfy::getAll(...$args);
    }
}
if (!function_exists('postAll')) {
    function postAll(...$args) {
        return Microfy::postAll(...$args);
    }
}
if (!function_exists('reqAll')) {
    function reqAll(...$args) {
        return Microfy::reqAll(...$args);
    }
}
if (!function_exists('injectGlobals')) {
    function injectGlobals(...$args) {
        return Microfy::injectGlobals(...$args);
    }
}
if (!function_exists('dbPdo')) {
    function dbPdo(...$args) {
        return Microfy::dbPdo(...$args);
    }
}
if (!function_exists('dbAll')) {
    function dbAll(...$args) {
        return Microfy::dbAll(...$args);
    }
}
if (!function_exists('dbOne')) {
    function dbOne(...$args) {
        return Microfy::dbOne(...$args);
    }
}
if (!function_exists('dbVal')) {
    function dbVal(...$args) {
        return Microfy::dbVal(...$args);
    }
}
if (!function_exists('dbCount')) {
    function dbCount(...$args) {
        return Microfy::dbCount(...$args);
    }
}
if (!function_exists('dbExec')) {
    function dbExec(...$args) {
        return Microfy::dbExec(...$args);
    }
}
if (!function_exists('dbInsertId')) {
    function dbInsertId(...$args) {
        return Microfy::dbInsertId(...$args);
    }
}
if (!function_exists('dbExists')) {
    function dbExists(...$args) {
        return Microfy::dbExists(...$args);
    }
}
if (!function_exists('dbError')) {
    function dbError(...$args) {
        return Microfy::dbError(...$args);
    }
}
if (!function_exists('dbMysqli')) {
    function dbMysqli(...$args) {
        return Microfy::dbMysqli(...$args);
    }
}
if (!function_exists('pp')) {
    function pp(...$args) {
        return Microfy::pp(...$args);
    }
}
if (!function_exists('ppd')) {
    function ppd(...$args) {
        return Microfy::ppd(...$args);
    }
}
if (!function_exists('mpp')) {
    function mpp(...$args) {
        return Microfy::mpp(...$args);
    }
}
if (!function_exists('mppd')) {
    function mppd(...$args) {
        return Microfy::mppd(...$args);
    }
}
if (!function_exists('ppr')) {
    function ppr(...$args) {
        return Microfy::ppr(...$args);
    }
}
if (!function_exists('pper')) {
    function pper(...$args) {
        return Microfy::pper(...$args);
    }
}
if (!function_exists('pd')) {
    function pd(...$args) {
        return Microfy::pd(...$args);
    }
}
if (!function_exists('pdd')) {
    function pdd(...$args) {
        return Microfy::pdd(...$args);
    }
}
if (!function_exists('pdr')) {
    function pdr(...$args) {
        return Microfy::pdr(...$args);
    }
}
if (!function_exists('d')) {
    function d(...$args) {
        return Microfy::d(...$args);
    }
}
if (!function_exists('dd')) {
    function dd(...$args) {
        return Microfy::dd(...$args);
    }
}
if (!function_exists('mlog')) {
    function mlog(...$args) {
        return Microfy::mlog(...$args);
    }
}
if (!function_exists('logPr')) {
    function logPr(...$args) {
        return Microfy::logPr(...$args);
    }
}
if (!function_exists('logVd')) {
    function logVd(...$args) {
        return Microfy::logVd(...$args);
    }
}
if (!function_exists('debugSession')) {
    function debugSession(...$args) {
        return Microfy::debugSession(...$args);
    }
}
if (!function_exists('env')) {
    function env(...$args) {
        return Microfy::env(...$args);
    }
}
if (!function_exists('now')) {
    function now(...$args) {
        return Microfy::now(...$args);
    }
}
if (!function_exists('jsonf')) {
    function jsonf(...$args) {
        return Microfy::jsonf(...$args);
    }
}
if (!function_exists('a')) {
    function a(...$args) {
        return Microfy::a(...$args);
    }
}
if (!function_exists('htmlTable')) {
    function htmlTable(...$args) {
        return Microfy::htmlTable(...$args);
    }
}
if (!function_exists('cList')) {
    function cList(...$args) {
        return Microfy::cList(...$args);
    }
}
if (!function_exists('load')) {
    function load(...$args) {
        return Microfy::load(...$args);
    }
}
if (!function_exists('def')) {
    function def(...$args) {
        return Microfy::def(...$args);
    }
}
if (!function_exists('hsc')) {
    function hsc(...$args) {
        return Microfy::hsc(...$args);
    }
}
if (!function_exists('json')) {
    function json(...$args) {
        return Microfy::json(...$args);
    }
}
if (!function_exists('ok')) {
    function ok(...$args) {
        return Microfy::ok(...$args);
    }
}
if (!function_exists('fail')) {
    function fail(...$args) {
        return Microfy::fail(...$args);
    }
}
if (!function_exists('slugify')) {
    function slugify(...$args) {
        return Microfy::slugify(...$args);
    }
}
if (!function_exists('h')) {
    function h(...$args) {
        return Microfy::h(...$args);
    }
}
if (!function_exists('b')) {
    function b(...$args) {
        return Microfy::b(...$args);
    }
}
if (!function_exists('i')) {
    function i(...$args) {
        return Microfy::i(...$args);
    }
}
if (!function_exists('bi')) {
    function bi(...$args) {
        return Microfy::bi(...$args);
    }
}
if (!function_exists('small')) {
    function small(...$args) {
        return Microfy::small(...$args);
    }
}
if (!function_exists('mark')) {
    function mark(...$args) {
        return Microfy::mark(...$args);
    }
}
if (!function_exists('p')) {
    function p(...$args) {
        return Microfy::p(...$args);
    }
}
if (!function_exists('span')) {
    function span(...$args) {
        return Microfy::span(...$args);
    }
}
if (!function_exists('div')) {
    function div(...$args) {
        return Microfy::div(...$args);
    }
}
if (!function_exists('section')) {
    function section(...$args) {
        return Microfy::section(...$args);
    }
}
if (!function_exists('code')) {
    function code(...$args) {
        return Microfy::code(...$args);
    }
}
if (!function_exists('codejs')) {
    function codejs(...$args) {
        return Microfy::codejs(...$args);
    }
}
if (!function_exists('codephp')) {
    function codephp(...$args) {
        return Microfy::codephp(...$args);
    }
}
if (!function_exists('codejson')) {
    function codejson(...$args) {
        return Microfy::codejson(...$args);
    }
}
if (!function_exists('codehtml')) {
    function codehtml(...$args) {
        return Microfy::codehtml(...$args);
    }
}
if (!function_exists('codesql')) {
    function codesql(...$args) {
        return Microfy::codesql(...$args);
    }
}
if (!function_exists('codebash')) {
    function codebash(...$args) {
        return Microfy::codebash(...$args);
    }
}
if (!function_exists('codec')) {
    function codec(...$args) {
        return Microfy::codec(...$args);
    }
}
if (!function_exists('ul')) {
    function ul(...$args) {
        return Microfy::ul(...$args);
    }
}
if (!function_exists('ulOpen')) {
    function ulOpen(...$args) {
        return Microfy::ulOpen(...$args);
    }
}
if (!function_exists('ulClose')) {
    function ulClose(...$args) {
        return Microfy::ulClose(...$args);
    }
}
if (!function_exists('li')) {
    function li(...$args) {
        return Microfy::li(...$args);
    }
}
if (!function_exists('br')) {
    function br(...$args) {
        return Microfy::br(...$args);
    }
}
if (!function_exists('bra')) {
    function bra(...$args) {
        return Microfy::bra(...$args);
    }
}
if (!function_exists('hr')) {
    function hr(...$args) {
        return Microfy::hr(...$args);
    }
}
if (!function_exists('hra')) {
    function hra(...$args) {
        return Microfy::hra(...$args);
    }
}
if (!function_exists('c')) {
    function c(...$args) {
        return Microfy::c(...$args);
    }
}
if (!function_exists('cStr')) {
    function cStr(...$args) {
        return Microfy::cStr(...$args);
    }
}
if (!function_exists('jsonArray')) {
    function jsonArray(...$args) {
        return Microfy::jsonArray(...$args);
    }
}
if (!function_exists('jsonString')) {
    function jsonString(...$args) {
        return Microfy::jsonString(...$args);
    }
}

