<?php
namespace com\mikebevz\xsd2php;
/**
 * Copyright 2010 Mike Bevz <myb@mikebevz.com>
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *   http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */


/**
 * Common data
 * 
 * @author Mike Bevz <myb@mikebevz.com>
 * @version 0.0.1
 */
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
    
    protected function parseDocComments($comments) {
        $comments = explode("\n", $comments);
        $commentsOut = array();
        foreach ($comments as $com) {
            if (preg_match('/@/', $com)) {
                $com = preg_replace('/\* /', '', $com);
                $com = preg_replace('/@([a-zA-Z]*)( *)(.*)/', '$1|$3', $com);
                $com = explode('|', $com);
                //$arr = array();
                $commentsOut[trim($com[0])] = trim($com[1]);
                //array_push($commentsOut, array($com[0] => $com[1]));
            }
        }
        
        return $commentsOut;
    }

}