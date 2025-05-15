<?php

return [
    //DebugYafStagePlugin::class,

    /*
     * routerStartup
     */
    ValidateAjaxRequestPlugin::class,
    /*
     * routerShutdown
     */
    LogRequestPlugin::class,
    /*
     * dispatchLoopStartup
     */
    StartSessionPlugin::class,
    /*
     * preDispatch
     */
        //..
    /*
     * postDispatch
     */
        //..
    /*
     * dispatchLoopShutdown
     */
    DisallowFrameEmbeddingPlugin::class,
];
