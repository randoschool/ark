<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\NewAvaliableTimes;
use Goutte\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class SendNewTimes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'times:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://eteenindus.mnt.ee/public/vabadSoidueksamiajad.xhtml');
        $dates[] = $crawler->filterXPath('//*[@id="eksami_ajad:kategooriaBEksamiAjad_data"]/tr')->each(function ($node) {
            if ($node->children()->text() === 'Kuressaare') {
                return $node->children()->each(function ($node) {
                    if ($node->text() !== 'Kuressaare' && $node->text() !== '') {
                        return Carbon::parse($node->text());
                    }
                });
            };
        });
        $times = collect($dates)->flatten()->filter(function ($date) {
            if ($date !== null) {
                if ($date->isBefore(Carbon::now()->addDays(30))) {
                    return $date;
                }
            }
        });
        if ($times->isNotEmpty()) {
            Mail::to('rando.oispuu@ametikool.ee')->send(new NewAvaliableTimes($times));
        }
        return 0;
    }
}
