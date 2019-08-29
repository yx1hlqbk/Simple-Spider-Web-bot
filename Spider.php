<?php

/**
 *
 */
class Spider
{
    /**
     * bots type
     */
    protected $bots = [
        'Google' => 'googlebot',
        'Baidu' => 'baiduspider',
        'Yahoo' => 'yahoo slurp',
        'Soso' => 'sosospider',
        'Msn' => 'msnbot',
        'Altavista' => 'scooter ',
        'Sogou' => 'sogou spider',
        'Yodao' => 'yodaobot'
    ];

    /**
     * run search spider bot
     */
    public function run()
    {
        $spi = '';

        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

        foreach ($this->bots as $k => $v){
            if (strstr($v, $userAgent)){
                $spi = $k;
                break;
            }
        }

        if ($spi != '') {
            $folder = './record/spider';

            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $file = $folder.'/'.date('Y-m-d').'.txt';

            $file = fopen($file, 'a+');

            $data = [
                'time' => date('Y-m-d H:i:s'),
                'robot' => $spi,
                'agent' => addslashes($_SERVER['HTTP_USER_AGENT']),
                'url' => $_SERVER['REQUEST_URI']
            ];

            fwrite($file, json_encode($data)."| \r\n");
            fclose($file);
        }
    }
}
