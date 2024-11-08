<?php

namespace App;

class Router
{
    // Array to store routes and their corresponding callbacks
    private $routes = [];
    private $notFoundCallback; // Property to hold the 404 callback

    // Method to add a route pattern and its callback
    public function add($pattern, $callback)
    {
        $this->routes[$pattern] = $callback;
    }

    // Method to set the callback for 404 errors
    public function set404($callback)
    {
        $this->notFoundCallback = $callback;
    }

    // Method to dispatch the request to the appropriate route callback
    public function dispatch($uri)
    {
        // Ensure $uri is a string
        if (!is_string($uri)) {
            $this->handleNotFound();
            return;
        }

        // Sanitize the URI
        $uri = filter_var($uri, FILTER_SANITIZE_URL);

        // Loop through all registered routes
        foreach ($this->routes as $pattern => $callback) {
            // Check if the URI matches the route pattern exactly
            if ($pattern === $uri) {
                return call_user_func($callback);
            } elseif (preg_match('/\{(\w+)\}/', $pattern, $matches)) { // Check for parameter in the pattern
                // Replace the parameter placeholder with a regex pattern to match digits
                $pattern = preg_replace('/\{(\w+)\}/', '(\d+)', $pattern);
                // Check if the URI matches the modified pattern
                if (preg_match('#^' . $pattern . '$#', $uri, $paramMatches)) {
                    // Call the callback with the matched parameters
                    return call_user_func_array($callback, array_slice($paramMatches, 1));
                }
            }
        }

        // If no route matches, invoke the 404 handler
        $this->handleNotFound();
    }

    // Method to handle 404 errors
    private function handleNotFound()
    {
        if ($this->notFoundCallback) {
            return call_user_func($this->notFoundCallback);
        }

        // Default 404 response if no callback is set
        http_response_code(404);
        require __DIR__ . '/Views/404.php';
    }
}
