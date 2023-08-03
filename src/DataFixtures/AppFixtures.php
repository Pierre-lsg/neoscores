<?php
namespace App\DataFixtures;

use App\Entity\Championship;
use App\Entity\Club;
use App\Entity\Competition;
use App\Entity\Member;
use App\Entity\Rule;
use App\Entity\Spot;
use App\Entity\Team;
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
            
            // Creating Competitions
            for ($j=0; $j < 4; $j++) 
            { 
                $competitionAt = $faker->dateTimeThisYear();
                $publishingScoreAt = $competitionAt->add(new \DateInterval('P1Y'));

                $competition[$j] = new Competition();
                $competition[$j]->setName($faker->city . '\'s competition');
                $competition[$j]->setCompetitionAt($competitionAt);
                $competition[$j]->setPublishingScoresAt($publishingScoreAt);
                $competition[$j]->setChampionship($championship[$i]);
                $competition[$j]->setNbTeamByFly(2);
                $competition[$j]->setNbMemberByTeam(2);
                $competition[$j]->setIsIndividual($faker->randomElement([true,false,false]));            

                $manager->persist($competition[$j]);
            }   

            // Creating club
            for ($j=0 ; $j < 5 ; $j++)
            {
                $club[$j] = new Club();
                $club[$j]->setName($faker->company());
                $club[$j]->setDescription($faker->text(100));
                $club[$j]->setChampionship($championship[$i]);

                $manager->persist($club[$j]);

                // Creating member
                for ($k=0 ; $k < 10 ; $k++)
                {
                    $member[$k] = new Member();
                    $member[$k]->setFirstName($faker->firstName());
                    $member[$k]->setLastName($faker->lastName());
                    $member[$k]->setClub($club[$j]);
                    $member[$k]->setChampionship($championship[$i]);

                    $manager->persist($member[$k]);
                }

                // Creating team
                for ($k=0 ; $k < 3 ; $k++)
                {
                    $team[$k] = new Team();
                    $team[$k]->setName(substr($club[$j]->getName(),0,8) . ' #' . $k + 1);
                    $team[$k]->setDescription($faker->text(20));
                    $team[$k]->setClub($club[$j]);
                    $team[$k]->setChampionship($championship[$i]);

                    $manager->persist($team[$k]);
                }
            }

            $manager->flush();
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

        // Creating rules
        $rule[0] = new Rule();
        $rule[0]->setName('individual');
        $rule[0]->setDescription('All hit counts');
        $rule[1] = new Rule();
        $rule[1]->setName('scramble');
        $rule[1]->setDescription('The best ball of the team for each hit');

        $manager->persist($rule[0]);
        $manager->persist($rule[1]);

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
