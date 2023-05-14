<?php

namespace App\Test\Controller;

use App\Entity\Member;
use App\Repository\MemberRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MemberControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private MemberRepository $repository;
    private string $path = '/member/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Member::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Member index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'member[firstName]' => 'Testing',
            'member[lastName]' => 'Testing',
            'member[nickName]' => 'Testing',
            'member[club]' => 'Testing',
            'member[team]' => 'Testing',
        ]);

        self::assertResponseRedirects('/member/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Member();
        $fixture->setFirstName('My Title');
        $fixture->setLastName('My Title');
        $fixture->setNickName('My Title');
        $fixture->setClub('My Title');
        $fixture->setTeam('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Member');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Member();
        $fixture->setFirstName('My Title');
        $fixture->setLastName('My Title');
        $fixture->setNickName('My Title');
        $fixture->setClub('My Title');
        $fixture->setTeam('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'member[firstName]' => 'Something New',
            'member[lastName]' => 'Something New',
            'member[nickName]' => 'Something New',
            'member[club]' => 'Something New',
            'member[team]' => 'Something New',
        ]);

        self::assertResponseRedirects('/member/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getFirstName());
        self::assertSame('Something New', $fixture[0]->getLastName());
        self::assertSame('Something New', $fixture[0]->getNickName());
        self::assertSame('Something New', $fixture[0]->getClub());
        self::assertSame('Something New', $fixture[0]->getTeam());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Member();
        $fixture->setFirstName('My Title');
        $fixture->setLastName('My Title');
        $fixture->setNickName('My Title');
        $fixture->setClub('My Title');
        $fixture->setTeam('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/member/');
    }
}
