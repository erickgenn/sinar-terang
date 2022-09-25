<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ManagerGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if ($_SESSION['role'] == 'admin') {
            return redirect()
                ->to('access/forbidden');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
