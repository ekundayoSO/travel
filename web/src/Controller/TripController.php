<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Entity\Trip;
use DateTimeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

#[Route('/api', name: 'api_')]
class TripController extends AbstractController
{
    #[Route('/trips', name: 'trip_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        $trips = $entityManager->getRepository(Trip::class)->findAll();

        $data = [];

        foreach ($trips as $trip) {
            $data[] = [
                'id' => $trip->getId(),
                'destination' => $trip->getDestination(),
                'checkIn' => $trip->getCheckIn()->format('Y-m-d'),
                'checkOut' => $trip->getCheckOut()->format('Y-m-d'),
                'name' => $trip->getName(),
                'email' => $trip->getEmail(),
                'mobile' => $trip->getMobile(),
                
            ];
        }

        return $this->json($data);
        
    }

    #[Route('/trips', name: 'create_trip', methods: ['POST'])]
    public function create(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $content = $request->getContent();
        $data = json_decode($content, true);
        
        $destination = $data['destination'] ?? null;
        $checkIn = $data['checkIn'] ?? null;
        $checkOut = $data['checkOut'] ?? null;
        $name = $data['name'] ?? null;
        $email = $data['email'] ?? null;
        $mobile = $data['mobile'] ?? null;

        $hashedEmail = hash('sha256', $email);
        $hashedMobile = hash('sha256', $mobile);

        $trip = new Trip();
        $trip->setDestination(trim($destination));
        $trip->setCheckIn(new \DateTime($checkIn));
        $trip->setCheckOut(new \DateTime($checkOut));
        $trip->setName(trim($name));
        $trip->setEmail(trim($hashedEmail));
        $trip->setMobile(trim($hashedMobile));
        
        $entityManager->persist($trip);
        $entityManager->flush();

        $data =  [
            'id' => $trip->getId(),
            'destination' => $trip->getDestination(),
            'checkIn' => $trip->getCheckIn()->format('Y-m-d'),
            'checkOut' => $trip->getCheckOut()->format('Y-m-d'),
            'name' => $trip->getName(),
            'email' => $trip->getEmail(),
            'mobile' => $trip->getMobile(),
            
        ];

        return $this->json($data);

        if (!$data) {
            return $this->redirectToRoute('trip_index');
        }

    }

    #[Route('/trips/{id}', name: 'trip_show', methods: ['GET'])]
    public function show(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $trip = $entityManager->getRepository(Trip::class)->find($id);

        if (!$trip) {

            return $this->json('No trip found for id ' . $id, 404);
        }

        $data =  [
            'id' => $trip->getId(),
            'destination' => $trip->getDestination(),
            'checkIn' => $trip->getCheckIn()->format('Y-m-d'),
            'checkOut' => $trip->getCheckOut()->format('Y-m-d'),
            'name' => $trip->getName(),
            'email' => $trip->getEmail(),
            'mobile' => $trip->getMobile(),
        ];

        return $this->json($data);
    }

    #[Route('/trips/{id}', name: 'trip_update', methods: ['PUT', 'PATCH'], requirements: ['id' => '\d+'])]
    public function update(EntityManagerInterface $entityManager, Request $request, int $id): JsonResponse
    {
        $content = $request->getContent();
        $data = json_decode($content, true);

        $destination = $data['destination'] ?? null;
        $checkIn = $data['checkIn'] ?? null;
        $checkOut = $data['checkOut'] ?? null;
        $name = $data['name'] ?? null;
        $email = $data['email'] ?? null;
        $mobile = $data['mobile'] ?? null;
        
        $trip = $entityManager->getRepository(Trip::class)->find($id);

        if (!$trip) {
            return $this->json('No trip found for id ' . $id, 404);
        }

        if ($email !== null) {
            $email = hash('sha256', $email);
        }
        if ($mobile !== null) {
            $mobile = hash('sha256', $mobile);
        }

        $trip->setDestination(trim($destination));
        $trip->setCheckIn(new \DateTime($checkIn));
        $trip->setCheckOut(new \DateTime($checkOut));
        $trip->setName(trim($name));
        $trip->setEmail(trim($email));
        $trip->setMobile(trim($mobile));
        
        $entityManager->persist($trip);
        $entityManager->flush();

        $data =  [
            'id' => $trip->getId(),
            'destination' => $trip->getDestination(),
            'checkIn' => $trip->getCheckIn()->format('Y-m-d'),
            'checkOut' => $trip->getCheckOut()->format('Y-m-d'),
            'name' => $trip->getName(),
            'email' => $trip->getEmail(),
            'mobile' => $trip->getMobile()
        ];
        return $this->json($data);
    }


    #[Route('/trips/{id}', name: 'trip_delete', methods: ['delete'])]
    public function delete(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $trip = $entityManager->getRepository(Trip::class)->find($id);

        if (!$trip) {
            return $this->json('No trip found for id ' . $id, 404);
        }

        $entityManager->remove($trip);
        $entityManager->flush();

        return $this->json('Deleted a trip successfully with id ' . $id);
    }
}
