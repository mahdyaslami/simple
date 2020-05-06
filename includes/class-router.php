<?php

class Router
{
    private $matchsCount = 0;
    public function getMatchsCount()
    {
        return $this->matchsCount;
    }

    private $acceptedCount = 0;
    public function getAcceptedCount()
    {
        return $this->acceptedCount;
    }

    public function resetCounters()
    {
        $this->matchsCount = 0;
        $this->acceptedCount = 0;
    }

    /**
     * Check if request uri and method match with route return true else false.
     * and when request uri match increment matchs count
     * 
     * @param string $method HTTP method: GET, POST, PUT, PATCH, DELETE, ...
     * @param string $pattern Contain pattern you want to match with request uri.
     * 
     * @return bool if request uri and method match with route return true else false.
     */
    public function request($method, $pattern)
    {
        global $request;
        if ($this->checkUri($request->uri, $pattern)) {
            $this->matchsCount++;
        }

        if (strtoupper($method) === $request->method) {
            $this->acceptedCount++;
            return true;
        }

        return false;
    }

    public function get($pattern)
    {
        return $this->request('GET', $pattern);
    }

    public function post($pattern)
    {
        return $this->request('POST', $pattern);
    }

    public function put($pattern)
    {
        return $this->request('PUT', $pattern);
    }

    public function delete($pattern)
    {
        return $this->request('DELETE', $pattern);
    }

    public function patch($pattern)
    {
        return $this->request('PATCH', $pattern);
    }

    /**
     * Check if uri match with pattern.
     * 
     * @param string $uri HTTP request path.
     * @param string $pattern Contain pattern you want to match with uri.
     *  number: /users/{num:id}
     *  string: /news/today/{subtitle}
     * 
     * @return bool if uri match return true else return false.
     */
    private function checkUri($uri, $pattern)
    {
        $pattern = preg_replace('/{num:\w+}/', '(\d+)', $pattern);
        $pattern = preg_replace('/{\w+}/', '(\w+)', $pattern);
        $pattern = str_replace('/', '\/', $pattern);

        $matchs = [];
        if (preg_match('/' . $pattern . '/', $uri, $matchs) !== 1) {
            return false;
        }

        if (
            isset($matchs[0]) === false
            || $matchs[0] !== $uri
        ) {
            return false;
        }

        return true;
    }

    /**
     * Check if request method match with wanted method.
     * 
     * @param string $requestMethod HTTP method: GET, POST, PUT, PATCH, DELETE, ...
     * @param string $method Contain method you want to match with requestMethod.
     * 
     * @return bool if match return true else return false.
     */
    private function checkMethod($requestMethod, $method)
    {
        return ;
    }
}
