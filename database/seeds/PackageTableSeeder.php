<?php
use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = [            
            ['id' => 2, 'name' => 'Reseller 1 month'],
            ['id' => 3, 'name' => 'Reseller 1 month w/Adult'],
            ['id' => 4, 'name' => 'Reseller 1 month - 2 Connections'],
            ['id' => 5, 'name' => 'Reseller 1 month w/Adult - 2 Connections'],
            ['id' => 6, 'name' => 'Reseller 1 month - 3 Connections'],
            ['id' => 7, 'name' => 'Reseller 1 month w/Adult - 3 Connections'],
            ['id' => 10, 'name' => 'Reseller 3 months'],
            ['id' => 11, 'name' => 'Reseller 3 months w/Adult'],
            ['id' => 19, 'name' => 'Reseller Trial 24 Hour'],
            ['id' => 20, 'name' => 'Reseller Trial 3 Days'],
            ['id' => 48, 'name' => 'VOD ONLY (NON ADULT)'],
            ['id' => 49, 'name' => 'VOD ONLY (ADULT)'],
            ['id' => 50, 'name' => 'No International 1 Month w/Adult'],
            ['id' => 51, 'name' => 'No International 1 Month'],
            ['id' => 52, 'name' => 'Reseller 3 months - 3 Connections'],
            ['id' => 53, 'name' => 'Reseller 3 month w/adult - 3 Connections'],
            ['id' => 54, 'name' => 'Reseller 2 months'],
            ['id' => 55, 'name' => 'Reseller 2 months wAdult'],
            ['id' => 56, 'name' => 'Reseller 2 months wAdult - 2 Connections'],
            ['id' => 57, 'name' => 'Reseller 2 months - 2 Connections'],
            ['id' => 58, 'name' => 'Reseller 2 months - 3 Connections'],
            ['id' => 59, 'name' => 'Reseller 2 months wAdult - 3 Connections'],
            ['id' => 60, 'name' => 'Reseller 3 month non (adult) - 2 Connections'],
            ['id' => 61, 'name' => 'Reseller 3 month (adult) - 2 Connections'],
            ['id' => 62, 'name' => 'No International - 2 Connections'],
            ['id' => 63, 'name' => 'No International - 3 Connections'],
            ['id' => 64, 'name' => 'No International - 2 Connections w/Adult'],
            ['id' => 65, 'name' => 'No International - 3 Connections w/Adult']
        ];
        $count=0;
        while ($count < count($packages))
        {
            if(Package::where('id', '=', $packages[$count]['id'])->first() === null)
            {
                Package::create([
                    'id' => $packages[$count]['id'],
                    'name' => $packages[$count]['name']
                ]);

            }
            $count++;
        }
    }
}
