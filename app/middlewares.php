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
    RenderViewPlugin::class,
    /*
     * dispatchLoopShutdown
     */
    DisallowFrameEmbeddingPlugin::class,
];
