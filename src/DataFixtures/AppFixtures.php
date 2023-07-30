<?php
namespace App\DataFixtures;

use App\Entity\Championship;
use App\Entity\Club;
use App\Entity\Competition;
use App\Entity\Spot;
use App\Entity\User;
use DateInterval;
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

        // Creating clubs
        for ($i=0 ; $i < 10 ; $i++)
        {
            $club[$i] = new Club();
            $club[$i]->setName($faker->company());
            $club[$i]->setDescription($faker->text(100));

            $manager->persist($club[$i]);
        }

        // Creating championships
        for ($i=0 ; $i < 10 ; $i++)
        {
            $csCountry = $faker->country();

            $championship[$i] = new Championship();
            $championship[$i]->setName($csCountry . '\'s Championship');
            $championship[$i]->setDescription($faker->text(100));
            $championship[$i]->setSeason($faker->randomElement(['2023','2024','2025']));
            $championship[$i]->setIsInternal($faker->randomElement([true,false]));            

            $manager->persist($championship[$i]);
            $manager->flush();
            
            // Creating Competitions
            for ($j=0; $j < 4; $j++) 
            { 
                $competitionAt = $faker->dateTimeThisYear();
                $publishingScoreAt = $competitionAt->add(new \DateInterval('P1Y'));

                $competition[$i] = new Competition();
                $competition[$i]->setName($faker->city . '\'s competition');
                $competition[$i]->setCompetitionAt($competitionAt);
                $competition[$i]->setPublishingScoresAt($publishingScoreAt);
                $competition[$i]->setChampionship($championship[$i]);
                $competition[$i]->setNbTeamByFly(2);
                $competition[$i]->setNbMemberByTeam(2);
                $competition[$i]->setIsIndividual($faker->randomElement([true,false,false]));            

                $manager->persist($competition[$i]);
            }   
        }

        // Creating spots
        $spotName = ['beginner', 'regular', 'advanced'];
        for ($i=0 ; $i < 10 ; $i++)
        {
            $spot[$i] = new Spot();
            $spot[$i]->setName($spotName[$i % 3]);
            $spot[$i]->setPlace($faker->text(100));
            $spot[$i]->setCity($faker->city);
            $spot[$i]->setCountry($faker->country);            

            $manager->persist($spot[$i]);
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
