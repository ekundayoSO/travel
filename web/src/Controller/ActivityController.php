<?php

namespace App\Controller;

use App\Entity\Activity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class ActivityController extends AbstractController
{
    #[Route('/activities', name: 'activity_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        $activities = $entityManager->getRepository(Activity::class)->findAll();
        $data = array_map(fn ($activity) => [
            'id' => $activity->getId(),
            'dayOne' => $activity->getDay1(),
            'dayTwo' => $activity->getDay2(),
            'dayThree' => $activity->getDay3(),
            'dayFour' => $activity->getDay4(),
            'dayFive' => $activity->getDay5(),
            'longitude' => $activity->getLongitude(),
            'latitude' => $activity->getLatitude()
        ], $activities);

        return $this->json($data);
    }

    #[Route('/activities', name: 'create_activity', methods: ['POST'])]
    public function create(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $activity = new Activity();
        $activity->setDay1(trim($data['dayOne'] ?? ''))
            ->setDay2(trim($data['dayTwo'] ?? ''))
            ->setDay3(trim($data['dayThree'] ?? ''))
            ->setDay4(trim($data['dayFour'] ?? ''))
            ->setDay5(trim($data['dayFive'] ?? ''))
            ->setLongitude(trim($data['longitude'] ?? ''))
            ->setLatitude(trim($data['latitude'] ?? ''));

        $entityManager->persist($activity);
        $entityManager->flush();

        return $this->json([
            'id' => $activity->getId(),
            'dayOne' => $activity->getDay1(),
            'dayTwo' => $activity->getDay2(),
            'dayThree' => $activity->getDay3(),
            'dayFour' => $activity->getDay4(),
            'dayFive' => $activity->getDay5(),
            'longitude' => $activity->getLongitude(),
            'latitude' => $activity->getLatitude()
        ]);
    }

    #[Route('/activities/{id}', name: 'activity_show', methods: ['GET'])]
    public function show(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $activity = $entityManager->getRepository(Activity::class)->find($id);

        if (!$activity) {
            return $this->json(['error' => 'No activity found for id ' . $id], 404);
        }

        return $this->json([
            'id' => $activity->getId(),
            'dayOne' => $activity->getDay1(),
            'dayTwo' => $activity->getDay2(),
            'dayThree' => $activity->getDay3(),
            'dayFour' => $activity->getDay4(),
            'dayFive' => $activity->getDay5(),
            'longitude' => $activity->getLongitude(),
            'latitude' => $activity->getLatitude()
        ]);
    }

    #[Route('/activities/{id}', name: 'activity_update', methods: ['PUT', 'PATCH'], requirements: ['id' => '\d+'])]
    public function update(EntityManagerInterface $entityManager, Request $request, int $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $activity = $entityManager->getRepository(Activity::class)->find($id);

        if (!$activity) {
            return $this->json(['error' => 'No activity found for id ' . $id], 404);
        }

        $activity->setDay1(trim($data['dayOne'] ?? ''))
            ->setDay2(trim($data['dayTwo'] ?? ''))
            ->setDay3(trim($data['dayThree'] ?? ''))
            ->setDay4(trim($data['dayFour'] ?? ''))
            ->setDay5(trim($data['dayFive'] ?? ''))
            ->setLongitude(trim($data['longitude'] ?? ''))
            ->setLatitude(trim($data['latitude'] ?? ''));

        $entityManager->flush();

        return $this->json([
            'id' => $activity->getId(),
            'dayOne' => $activity->getDay1(),
            'dayTwo' => $activity->getDay2(),
            'dayThree' => $activity->getDay3(),
            'dayFour' => $activity->getDay4(),
            'dayFive' => $activity->getDay5(),
            'longitude' => $activity->getLongitude(),
            'latitude' => $activity->getLatitude()
        ]);
    }

    #[Route('/activities/{id}', name: 'activity_delete', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $activity = $entityManager->getRepository(Activity::class)->find($id);

        if (!$activity) {
            return $this->json(['error' => 'No activity found for id ' . $id], 404);
        }

        $entityManager->remove($activity);
        $entityManager->flush();

        return $this->json(['message' => 'Deleted activity successfully with id ' . $id]);
    }
}
