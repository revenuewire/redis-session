<?php
namespace RW;

use Predis\Client;

/**
 * Class RedisSession
 */
class RedisSession implements \SessionHandlerInterface
{
    private $redis;
    private $prefix;
    private $maxLifetime;

    /**
     * RedisSession constructor.
     *
     * @param Client $redis
     * @param string $prefix
     * @param null $ttl
     */
    public function __construct(Client $redis, $prefix = 's:', $ttl = null)
    {
        $this->redis = $redis;
        $this->prefix = $prefix;
        $this->maxLifetime = empty($ttl) ? ini_get('session.gc_maxlifetime') : $ttl;
    }

    /**
     * Open session
     *
     * @param string $savePath
     * @param string $name
     *
     * @return bool|void
     */
    public function open($savePath, $name)
    {
        //no need
    }

    /**
     * GC
     *
     * @param int $maxLifetime
     *
     * @return bool|void
     */
    public function gc($maxLifetime)
    {
        //no need
    }

    /**
     * Close Session
     */
    public function close()
    {
        unset($this->redis);
    }

    /**
     * DELETE SESSION
     *
     * @param  string $sessionId The session id.
     *
     * @return bool|void
     */
    public function destroy($sessionId)
    {
        $this->redis->del($this->prefix.$sessionId);
    }

    /**
     * Get Session
     *
     * @param  string $sessionId The session id.
     * @return string            The serialized session data.
     */
    public function read($sessionId)
    {
        $sessionId = $this->prefix.$sessionId;
        $sessionData = $this->redis->get($sessionId);

        // Refresh the Expire
        $this->redis->expire($sessionId, $this->maxLifetime);

        return $sessionData;
    }

    /**
     * Write session
     *
     * @param string $sessionId
     * @param string $sessionData
     *
     * @return bool|void
     */
    public function write($sessionId, $sessionData)
    {
        $sessionId = $this->prefix.$sessionId;

        // Write the session data to Redis.
        $this->redis->set($sessionId, $sessionData);

        // Set the expire so we don't have to rely on PHP's gc.
        $this->redis->expire($sessionId, $this->maxLifetime);
    }
}