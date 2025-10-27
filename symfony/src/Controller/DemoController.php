<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    private function startLegacySession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            if (!empty($_COOKIE['PHPSESSID'])) {
                session_id($_COOKIE['PHPSESSID']);
            }
            session_start();
        }

        // set default user (for demo purposes)
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = ['id' => 1, 'name' => 'Legacy User (created by SF)'];
        }
    }

    #[Route('/me')]
    public function me(): Response
    {
        $this->startLegacySession();

        return new Response(json_encode([
            'cookies' => $_COOKIE,
            'session_id' => session_id(),
            'user' => $_SESSION['user']
        ], JSON_PRETTY_PRINT));
    }

    #[Route('/update-session')]
    public function change(): Response
    {
        $this->startLegacySession();

        $_SESSION['user'] = [
            'id' => 666,
            'name' => 'CHANGED BY SF'
        ];

        return new Response(json_encode([
            'cookies' => $_COOKIE,
            'session_id' => session_id(),
            'user' => $_SESSION['user']
        ], JSON_PRETTY_PRINT));
    }
}
