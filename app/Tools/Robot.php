<?php

namespace App\Tools;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Robot 
{
    protected static $credentials = [
        'login' => 'henrylopez',
        'pass' => 'spring88'
    ];

    protected static $commandsFormats = [
        "verify" => "curl 'https://cms-usa.xtream-codes.com/xce677a7/userpanel/index.php?action=information' -H 'cookie: __cfduid=d732ec8433523c4af4583e91aebc239bc1529700615; open_div=StreamingLines; PHPSESSID=58e2227543d15cb3a3222f6def96fc1c' -H 'accept-encoding: gzip, deflate, br' -H 'accept-language: es-NI,es-419;q=0.9,es;q=0.8,en;q=0.7' -H 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36' -H 'accept: */*' -H 'referer: https://cms-usa.xtream-codes.com/xce677a7/userpanel/index.php' -H 'authority: cms-usa.xtream-codes.com' -H 'x-requested-with: XMLHttpRequest' --compressed -s -o /dev/null -w '%{http_code}'",

        "login" => "curl 'https://cms-usa.xtream-codes.com/xce677a7/index.php?action=login' -H 'authority: cms-usa.xtream-codes.com' -H 'cache-control: max-age=0' -H 'origin: https://cms-usa.xtream-codes.com' -H 'upgrade-insecure-requests: 1' -H 'content-type: application/x-www-form-urlencoded' -H 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36' -H 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8' -H 'referer: https://cms-usa.xtream-codes.com/xce677a7/index.php' -H 'accept-encoding: gzip, deflate, br' -H 'accept-language: es-NI,es-419;q=0.9,es;q=0.8,en;q=0.7' -H 'cookie: __cfduid=d732ec8433523c4af4583e91aebc239bc1529700615; open_div=StreamingLines; PHPSESSID=58e2227543d15cb3a3222f6def96fc1c' --data '%s' --compressed",

        "smallinfo" => "curl 'https://cms-usa.xtream-codes.com/xce677a7/userpanel/index.php?action=information' -H 'cookie: __cfduid=d732ec8433523c4af4583e91aebc239bc1529700615; open_div=StreamingLines; PHPSESSID=58e2227543d15cb3a3222f6def96fc1c' -H 'accept-encoding: gzip, deflate, br' -H 'accept-language: es-NI,es-419;q=0.9,es;q=0.8,en;q=0.7' -H 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36' -H 'accept: */*' -H 'referer: https://cms-usa.xtream-codes.com/xce677a7/userpanel/index.php' -H 'authority: cms-usa.xtream-codes.com' -H 'x-requested-with: XMLHttpRequest' --compressed",

        "alllines" => "curl 'https://cms-usa.xtream-codes.com/xce677a7/userpanel/mnglines.php?action=load_users' -H 'cookie: __cfduid=d732ec8433523c4af4583e91aebc239bc1529700615; open_div=StreamingLines; PHPSESSID=58e2227543d15cb3a3222f6def96fc1c' -H 'origin: https://cms-usa.xtream-codes.com' -H 'accept-encoding: gzip, deflate, br' -H 'accept-language: es-NI,es-419;q=0.9,es;q=0.8,en;q=0.7' -H 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36' -H 'content-type: application/x-www-form-urlencoded' -H 'accept: text/plain, */*; q=0.01' -H 'referer: https://cms-usa.xtream-codes.com/xce677a7/userpanel/mnglines.php' -H 'authority: cms-usa.xtream-codes.com' -H 'x-requested-with: XMLHttpRequest' --compressed",

        "addline" => "curl 'https://cms-usa.xtream-codes.com/xce677a7/userpanel/add_user.php?action=add_user' -H 'authority: cms-usa.xtream-codes.com' -H 'cache-control: max-age=0' -H 'origin: https://cms-usa.xtream-codes.com' -H 'upgrade-insecure-requests: 1' -H 'content-type: application/x-www-form-urlencoded' -H 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36' -H 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8' -H 'referer: https://cms-usa.xtream-codes.com/xce677a7/userpanel/add_user.php' -H 'accept-encoding: gzip, deflate, br' -H 'accept-language: es-NI,es-419;q=0.9,es;q=0.8,en;q=0.7' -H 'cookie: __cfduid=d732ec8433523c4af4583e91aebc239bc1529700615; open_div=StreamingLines; PHPSESSID=58e2227543d15cb3a3222f6def96fc1c' --data '%s' --compressed",

        "editline" => "curl 'https://cms-usa.xtream-codes.com/xce677a7/userpanel/mnglines.php?action=edit%s' -H 'authority: cms-usa.xtream-codes.com' -H 'cache-control: max-age=0' -H 'origin: https://cms-usa.xtream-codes.com' -H 'upgrade-insecure-requests: 1' -H 'content-type: application/x-www-form-urlencoded' -H 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36' -H 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8' -H 'referer: https://cms-usa.xtream-codes.com/xce677a7/userpanel/mnglines.php' -H 'accept-encoding: gzip, deflate, br' -H 'accept-language: es-NI,es-419;q=0.9,es;q=0.8,en;q=0.7' -H 'cookie: __cfduid=d732ec8433523c4af4583e91aebc239bc1529700615; open_div=StreamingLines; PHPSESSID=58e2227543d15cb3a3222f6def96fc1c' --data '%s' --compressed -s -o /dev/null -w '%%{http_code}'",

        "extendline" => "curl 'https://cms-usa.xtream-codes.com/xce677a7/userpanel/extend.php?action=extend' -H 'authority: cms-usa.xtream-codes.com' -H 'cache-control: max-age=0' -H 'origin: https://cms-usa.xtream-codes.com' -H 'upgrade-insecure-requests: 1' -H 'content-type: application/x-www-form-urlencoded' -H 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36' -H 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8' -H 'referer: https://cms-usa.xtream-codes.com/xce677a7/userpanel/extend.php' -H 'accept-encoding: gzip, deflate, br' -H 'accept-language: es-NI,es-419;q=0.9,es;q=0.8,en;q=0.7' -H 'cookie: __cfduid=d732ec8433523c4af4583e91aebc239bc1529700615; open_div=StreamingLines; PHPSESSID=58e2227543d15cb3a3222f6def96fc1c' --data '%s' --compressed -s -o /dev/null -w '%%{http_code}'",

        "deleteline" => "curl 'https://cms-usa.xtream-codes.com/xce677a7/userpanel/mnglines.php?action=user_delete%s' -H 'authority: cms-usa.xtream-codes.com' -H 'upgrade-insecure-requests: 1' -H 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36' -H 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8' -H 'referer: https://cms-usa.xtream-codes.com/xce677a7/userpanel/mnglines.php' -H 'accept-encoding: gzip, deflate, br' -H 'accept-language: es-NI,es-419;q=0.9,es;q=0.8,en;q=0.7' -H 'cookie: __cfduid=d732ec8433523c4af4583e91aebc239bc1529700615; open_div=StreamingLines; PHPSESSID=58e2227543d15cb3a3222f6def96fc1c' --compressed -s -o /dev/null -w '%%{http_code}'",

        "packageinfo" => "curl 'https://cms-usa.xtream-codes.com/xce677a7/userpanel/add_user.php?action=package_info&id=2' -H 'cookie: __cfduid=d732ec8433523c4af4583e91aebc239bc1529700615; open_div=StreamingLines; PHPSESSID=58e2227543d15cb3a3222f6def96fc1c' -H 'accept-encoding: gzip, deflate, br' -H 'accept-language: es-NI,es-419;q=0.9,es;q=0.8,en;q=0.7' -H 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36' -H 'accept: */*' -H 'referer: https://cms-usa.xtream-codes.com/xce677a7/userpanel/add_user.php' -H 'authority: cms-usa.xtream-codes.com' -H 'x-requested-with: XMLHttpRequest' --compressed"
    ];
    
    public static function GetSmallInfo()
    {
        $command=self::$commandsFormats['smallinfo'];
        $output="";
        if(self::VerifySession())
        {
            $output=self::ExecuteCommand($command, null);
        }
        else {
            $output= json_encode(['error' => 'Se ha producido un error!']);
        }
        return $output;
    }

    public static function GetAllLines()
    {
        $command=self::$commandsFormats['alllines'];
        $output="";
        if(self::VerifySession())
        {
            $output=self::ExecuteCommand($command, null);
        }
        else {
            $output= json_encode(['error' => 'Se ha producido un error!']);
        }
        return $output;
    }

    public static function GetLineIdByName($name)
    {
        $lines=json_decode(self::GetAllLines(), true);
        foreach ($lines['records'] as $line) {
            if($line['username']==$name)
            {
                $subject=$line['download'];
                $pattern = '/user_id=[0-9]*/';
                $matches=NULL;
                if(preg_match($pattern, $subject, $matches))
                {
                    return substr($matches[0], 8);;
                }
                else {
                    return false;
                }
            }
        }
    }
    
    public static function AddLine($data)
    {
        $command=self::$commandsFormats['addline'];
        $strdata="username=".urlencode($data['username'])."&password=".urlencode($data['password'])."&package_id=".urlencode($data['package_id'])."&line_type=official&reseller_notes=".urlencode($data['reseller_notes']);
        if(self::VerifySession())
        {
            $output=self::ExecuteCommand($command, $strdata);
            $pos=strpos($output, '<h4 class="alert_success">User added</h4>');
            if($pos != null)
            {
                return true;
            } else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    public static function ExtendLine($data)
    {
        $command=self::$commandsFormats['extendline'];
        $strdata="user_id=".urlencode($data['line_id'])."&package_id=".urlencode($data['package_id'])."&line_type=official";
        if(self::VerifySession())
        {
            $output=self::ExecuteCommand($command, $strdata);
            if($output == "200")
            {
                return true;
            } else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    
    public static function EditLine($data)
    {
        $command=self::$commandsFormats['editline'];
        $strId="&user_id=".urlencode($data['line_id']);
        $strdata="password=".urlencode($data['password'])."&reseller_notes=".urlencode($data['reseller_notes'])."&post=1";
        if(self::VerifySession())
        {
            $output=self::ExecuteCommandEdit($command, $strId, $strdata);
            if($output == "200")
            {
                return true;
            } else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    public static function DeleteLine($data)
    {
        $command=self::$commandsFormats['deleteline'];
        $strdata="&user_id=".urlencode($data['line_id']);
        if(self::VerifySession())
        {
            $output=self::ExecuteCommand($command, $strdata);
            if($output == "200")
            {
                return true;
            } else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    public static function VerifySession()
    {
        $verifycmd=self::$commandsFormats['verify'];
        $logincmd=self::$commandsFormats['login'];
        $response=null;
        try {
            $response=self::ExecuteCommand($verifycmd, null);
            if($response==='200')
            {
                return true;
            }
            else {
                $response=self::ExecuteCommand($logincmd, "login=".self::$credentials['login']."&pass=".self::$credentials['pass']);
                return true;
            }
        }
        catch (Exception $e) {
            return false;
        }
    }

    public static function ExecuteCommand($command, $data)
    {
        $cmd="";
        if($data != null)
        {
            $cmd = sprintf($command, $data);
        }
        else {
            $cmd = $command;
        }
        $process = new Process($cmd);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        return $process->getOutput();
    }
    public static function ExecuteCommandEdit($command, $dataID, $dataValues)
    {
        $cmd = sprintf($command, $dataID, $dataValues);
        $process = new Process($cmd);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        return $process->getOutput();
    }
}