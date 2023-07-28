<?php
namespace App\DataFixtures;

use App\Entity\Championship;
use App\Entity\Club;
use App\Entity\Member;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('en_US');

        // Creating users
        for ($i=0 ; $i < 8 ; $i++)
        {
            $user[$i] = new User();
            $user[$i]->setUsername($faker->firstName);
            $user[$i]->setRoles($this->defineUserRole($i));
            //Default password : password
            $user[$i]->setPassword('$2y$13$dtSOmbYNWVvA/xmjhevFMemy1.67yF9mKzL2gpVpbSli/9jdEycoq');            
            $manager->persist($user[$i]);
        }

        // Creating club
        for ($i=0 ; $i < 10 ; $i++)
        {
            $club[$i] = new Club();
            $club[$i]->setName($faker->company());
            $club[$i]->setDescription($faker->text());
            $manager->persist($club[$i]);
        }

        // Creating championship
        for ($i=0 ; $i < 10 ; $i++)
        {
            $championship[$i] = new Championship();
            $championship[$i]->setName($faker->city() . '\'s Championship');
            $championship[$i]->setDescription($faker->text());
            $championship[$i]->setSeason($faker->randomElement(['2023','2024','2025']));
            $championship[$i]->setIsInternal($faker->randomElement([true,false]));            
            $manager->persist($championship[$i]);
        }

        // Creating Club's members
/*         foreach ($club as $aClub) {
            for ($j=0; $j < 10 ; $j++) { 
                $member[$j] = new Member('');
                $member[$j]->setFirstName($faker->firstName);
                $member[$j]->setLastName($faker->lastName);
                $manager->persist($member[$j]);
            }
        }
 */
        $manager->flush();
    }

    public function defineUserRole(int $i): array
    {
        $role = array();

        switch ($i) {
            case '0':
            case '1':
            $role = ['ROLE_ADMIN'];
            break;
        
            case '2':
            case '3':
                $role = ['ROLE_ORGA'];
                break;
                        
            default:
                $role = ['ROLE_USER'];
                break;
        }
        return $role;
    }
}
