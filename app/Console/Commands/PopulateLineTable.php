<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Tools\Robot;
use App\Models\Line;
use DOMDocument;

class PopulateLineTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'PopulateTableLine';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualizar todos los registros de la tabla "lines", desde el admin original';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $linesRemote=Robot::GetAllLines();
        if($linesRemote !== false)
        {
            $lines=json_decode($linesRemote, true);
            foreach ($lines['records'] as $line)
            {
                $subject=$line['download'];
                $pattern = '/user_id=[0-9]*/';
                $matches=NULL;
                $line_id=NULL;
                $status=NULL;
                $expire=NULL;
                if(preg_match($pattern, $subject, $matches))
                {
                    $line_id=substr($matches[0], 8);
                }
                $doc = new DOMDocument();
                $node = $doc->loadHTML($line['status'].$line['expire']);
                $node = $doc->getElementsByTagName('font')->item(0);
                if($node!=null) {
                    $status="<span style='color:".$node->getAttribute('color').";'>".$node->textContent."</span>";
                } else {
                    $status="-";
                }
                $node = $doc->getElementsByTagName('font')->item(1);
                if($node!=null) {
                    $expire="<span style='color:".$node->getAttribute('color').";'>".$node->textContent."</span>";
                } else {
                    $expire="-";
                }

                $localline=Line::where('username', $line['username'])->first();
                if(!$localline)
                {
                    Line::create([
                        'line_id' => $line_id,
                        'status' => $status,
                        'username' => $line['username'],
                        'password' => $line['password'],
                        'expire' => $expire,
                        'line_type' => 'official',
                        'reseller_notes' => $line['notes']
                    ]);
                }
                else {
                    $localline->line_id = $line_id;
                    $localline->status = $status;
                    $localline->password = $line['password'];
                    $localline->expire = $expire;
                    $localline->reseller_notes = $line['notes'];
                    $localline->save();
                }
            }
        }
    }
}
