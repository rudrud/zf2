<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Filter
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend\Filter;

use Zend\ServiceManager\AbstractPluginManager;

/**
 * Plugin manager implementation for the filter chain.
 *
 * Enforces that filters retrieved are either callbacks or instances of
 * FilterInterface. Additionally, it registers a number of default filters
 * available, as well as aliases for them.
 *
 * @category   Zend
 * @package    Zend_Filter
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class FilterPluginManager extends AbstractPluginManager
{
    /**
     * Default set of filters
     * 
     * @var array
     */
    protected $invokableClasses = array(
        'alnum'                     => 'Zend\Filter\Alnum',
        'alpha'                     => 'Zend\Filter\Alpha',
        'basename'                  => 'Zend\Filter\BaseName',
        'boolean'                   => 'Zend\Filter\Boolean',
        'callback'                  => 'Zend\Filter\Callback',
        'compress'                  => 'Zend\Filter\Compress',
        'compressbz2'               => 'Zend\Filter\Compress\Bz2',
        'compressgz'                => 'Zend\Filter\Compress\Gz',
        'compresslzf'               => 'Zend\Filter\Compress\Lzf',
        'compressrar'               => 'Zend\Filter\Compress\Rar',
        'compresstar'               => 'Zend\Filter\Compress\Tar',
        'compresszip'               => 'Zend\Filter\Compress\Zip',
        'decompress'                => 'Zend\Filter\Decompress',
        'decrypt'                   => 'Zend\Filter\Decrypt',
        'digits'                    => 'Zend\Filter\Digits',
        'dir'                       => 'Zend\Filter\Dir',
        'encrypt'                   => 'Zend\Filter\Encrypt',
        'encryptmcrypt'             => 'Zend\Filter\Encrypt\Mcrypt',
        'encryptopenssl'            => 'Zend\Filter\Encrypt\Openssl',
        'filedecrypt'               => 'Zend\Filter\File\Decrypt',
        'fileencrypt'               => 'Zend\Filter\File\Encrypt',
        'filelowercase'             => 'Zend\Filter\File\LowerCase',
        'filerename'                => 'Zend\Filter\File\Rename',
        'fileuppercase'             => 'Zend\Filter\File\UpperCase',
        'htmlentities'              => 'Zend\Filter\HtmlEntities',
        'inflector'                 => 'Zend\Filter\Inflector',
        'int'                       => 'Zend\Filter\Int',
        'localizedtonormalized'     => 'Zend\Filter\LocalizedToNormalized',
        'normalizedtolocalized'     => 'Zend\Filter\NormalizedToLocalized',
        'null'                      => 'Zend\Filter\Null',
        'pregreplace'               => 'Zend\Filter\PregReplace',
        'realpath'                  => 'Zend\Filter\RealPath',
        'stringtolower'             => 'Zend\Filter\StringToLower',
        'stringtoupper'             => 'Zend\Filter\StringToUpper',
        'stringtrim'                => 'Zend\Filter\StringTrim',
        'stripnewlines'             => 'Zend\Filter\StripNewlines',
        'striptags'                 => 'Zend\Filter\StripTags',
        'wordcamelcasetodash'       => 'Zend\Filter\Word\CamelCaseToDash',
        'wordcamelcasetoseparator'  => 'Zend\Filter\Word\CamelCaseToSeparator',
        'wordcamelcasetounderscore' => 'Zend\Filter\Word\CamelCaseToUnderscore',
        'worddashtocamelcase'       => 'Zend\Filter\Word\DashToCamelCase',
        'worddashtoseparator'       => 'Zend\Filter\Word\DashToSeparator',
        'worddashtounderscore'      => 'Zend\Filter\Word\DashToUnderscore',
        'wordseparatortocamelcase'  => 'Zend\Filter\Word\SeparatorToCamelCase',
        'wordseparatortodash'       => 'Zend\Filter\Word\SeparatorToDash',
        'wordseparatortoseparator'  => 'Zend\Filter\Word\SeparatorToSeparator',
        'wordunderscoretocamelcase' => 'Zend\Filter\Word\UnderscoreToCamelCase',
        'wordunderscoretodash'      => 'Zend\Filter\Word\UnderscoreToDash',
        'wordunderscoretoseparator' => 'Zend\Filter\Word\UnderscoreToSeparator',
    );

    /**
     * Validate the plugin
     *
     * Checks that the filter loaded is either a valid callback or an instance
     * of FilterInterface.
     * 
     * @param  mixed $plugin 
     * @return void
     * @throws Exception\RuntimeException if invalid
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof FilterInterface) {
            // we're okay
            return;
        }
        if (is_callable($plugin)) {
            // also okay
            return;
        }

        throw new Exception\RuntimeException(sprintf(
            'Plugin of type %s is invalid; must implement %s\FilterInterface or be callable',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}
