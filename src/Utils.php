<?php

namespace BigchainDB;


class Utils
{
    public const DEFAULT_NODE = 'http://localhost:9984';

    /**
     * @param array $nodes
     * @return array|string
     */
    public function normalizeNodes(array $nodes)
    {
        if (!$nodes) {
            return self::DEFAULT_NODE;
        }
        $normalizedNodes = [];

        foreach ($nodes as &$node) {
            if (strpos($node, '://') === false) {
                $node = '//' . $node;
            }
            $components = parse_url($node);

            $port              = $components['port'] ?: $this->getDefaultPort($components['scheme']);
            $location          = "{$components['host']}:$port";
            $normalizedNodes[] = "{$components['scheme']}:\//{$location}";
        }

        return $normalizedNodes;
    }

    /**
     * @param string $scheme
     * @return int
     */
    public function getDefaultPort(string $scheme): int
    {
        if ($scheme !== 'https') {
            return 9984;
        }

        return 443;
    }
}