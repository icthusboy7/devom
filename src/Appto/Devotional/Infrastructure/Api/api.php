<?php

/**
 * @license Apache 2.0
 */

/**
 * @OA\Info(
 *     description="This is a DEVOM server.  You can find out more about Devotionals at
        [http://appto.eu/devom](http://appto.eu/devom)",
 *     version="1.0.0",
 *     title="Appto Devotional",
 *     @OA\Contact(
 *         name="Devom Team",
 *         email="devom@appto.eu"
 *     )
 *
 * )
 */
/**
 * @OA\Tag(
 *     name="Devotional",
 *     description="Everything about Devotionals"
 * )
 * @OA\Tag(
 *     name="YearlyPlan",
 *     description="Everything about Yearly Plans"
 * )
 * @OA\Server(
 *      url="{server}/api/v1",
 *      description="Appto Devotional API Mocking",
 *      @OA\ServerVariable(
 *          serverVariable="server",
 *          enum={"https://proservant-staging.herokuapp.com", "http://localhost:8030"},
 *          default="http://localhost:8030"
 *      )
 * )
 *
 * @OA\ExternalDocumentation(
 *     description="Find out more about Devotionals",
 *     url="http://appto.eu/devom"
 * )
 */
