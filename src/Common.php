<?php
namespace com\mikebevz\xsd2php;

class Common {
    
    protected $basicTypes = array('decimal', 'base64Binary', 'normalizedString', 
                                'dateTime', 'date', 'boolean',
                                'string', 'time', 'positiveInteger');
    
    protected $reservedWords = array (
        'and', 'or', 'xor', '__FILE__', 'exception',
        '__LINE__', 'array', 'as', 'break', 'case',
        'class', 'const', 'continue', 'declare', 'default',
        'die', 'do', 'echo', 'else', 'elseif',
        'empty', 'enddeclare', 'endfor', 'endforeach', 'endif',
        'endswitch', 'endwhile', 'eval', 'exit', 'extends',
        'for', 'foreach', 'function', 'global', 'if',
        'include', 'include_once', 'isset', 'list', 'new',
        'print', 'require', 'require_once', 'return', 'static',
        'switch', 'unset', 'use', 'var', 'while', 
        '__FUNCTION__', '__CLASS__', '__METHOD__', 'final', 'php_user_filter',
        'interface', 'implements', 'instanceof', 'public', 'private',
        'protected', 'abstract', 'clone', 'try', 'catch',
        'throw', 'this', 'final', '__NAMESPACE__', 'namespace', 'goto',
        '__DIR__'
    );

}