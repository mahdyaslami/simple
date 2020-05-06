<?php

class Router
{
    private $matchsCount = 0;

    /**
     * Get count of uri that match with routes
     * 
     * @return integer
     */
    public function getMatchsCount()
    {
        return $this->matchsCount;
    }

    private $acceptedCount = 0;

    /**
     * Get count of uri that accepted with a route (match method and uri together)
     * 
     * @return integer
     */
    public function getAcceptedCount()
    {
        return $this->acceptedCount;
    }

    /**
     * Set matchs count and accepted count to zero.
     */
    public function resetCounters()
    {
        $this->matchsCount = 0;
        $this->acceptedCount = 0;
    }

    private $baseUri = '';

    public function addBaseUri($pattern)
    {
        $this->baseUri = $pattern;
        return true;
    }

    public function resetBaseUri()
    {
        $this->baseUri = '';
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
        if ($this->acceptedCount > 0) {
            return false;
        }

        global $request;
        if ($this->checkUri($request->uri, $this->baseUri . $pattern) === false) {
            return false;
        }
        $this->matchsCount++;

        if (strtoupper($method) !== $request->method) {
            return false;
        }
        $this->acceptedCount++;

        return true;
    }

    /**
     * Get routes
     * 
     * @param string $pattern Contain pattern you want to match with request uri.
     * 
     * @return bool
     */
    public function get($pattern)
    {
        return $this->request('GET', $pattern);
    }

    /**
     * Post routes
     * 
     * @param string $pattern Contain pattern you want to match with request uri.
     * 
     * @return bool
     */
    public function post($pattern)
    {
        return $this->request('POST', $pattern);
    }

    /**
     * Put routes
     * 
     * @param string $pattern Contain pattern you want to match with request uri.
     * 
     * @return bool
     */
    public function put($pattern)
    {
        return $this->request('PUT', $pattern);
    }

    /**
     * Delete routes
     * 
     * @param string $pattern Contain pattern you want to match with request uri.
     * 
     * @return bool
     */
    public function delete($pattern)
    {
        return $this->request('DELETE', $pattern);
    }

    /**
     * Patch routes
     * 
     * @param string $pattern Contain pattern you want to match with request uri.
     * 
     * @return bool
     */
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
}
