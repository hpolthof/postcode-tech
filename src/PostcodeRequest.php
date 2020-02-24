<?php


namespace Hpolthof\PostcodeTech;


use Hpolthof\PostcodeTech\Exceptions\PostcodeNotFoundException;
use Hpolthof\PostcodeTech\Exceptions\ValidationException;

class PostcodeRequest implements PostcodeRequestInterface
{
    const BASE_URL = 'https://postcode.tech';

    private string $token = '';

    public function find(string $postcode, int $number): PostcodeResponseInterface
    {
        $request = new Request();
        $request->setBearer($this->getToken());

        $response = $request->get(self::BASE_URL.'/api/v1/postcode?'.http_build_query(compact('postcode', 'number')));

        if ($response->isError()) {
            switch ($response->status()) {
                case 404:
                    throw (new PostcodeNotFoundException("Postcode was not found."))
                        ->setResponse($response->getException()->response());
                case 422:
                    throw (new ValidationException("Validation Error"))
                        ->setResponse($response->getException()->response());
                default:
                    throw $response->getException();
            }

        }

        if ($response->isOk()) {
            $result = $response->json();

            return (new PostcodeResponse())
                ->setPostcode($postcode)
                ->setNumber($number)
                ->setStreet($result->street)
                ->setCity($result->city);
        }

        throw new \Exception("Unknown error.");
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): PostcodeRequest
    {
        $this->token = $token;
        return $this;
    }
}