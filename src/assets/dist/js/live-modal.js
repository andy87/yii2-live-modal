
if ( window.liveModalLibraryData === undefined ) window.liveModalLibraryData = {};
if ( window.liveModalLibraryHandlers === undefined ) window.liveModalLibraryHandlers = {};
/**
 * yii2\frontend\assets\blocks::LiveDataModalAsset()
 */
const LiveModalLibraryData = window.liveModalLibraryData || {
    requestId : {
        request_id :"modalContainerView",
        container :"modalContainerView",
        endpoint : " /api/modal/get-html-view",
        id : null,
        model : "design",   
        type :  "view"
    }
};

const LiveModalLibraryHandlers = window.liveModalLibraryHandlers || {};

const liveModal = {

    selector : 'data-live-modal',

    cache : null,

    init : function (selector){

        window.addEventListener('load',function ()
        {
            liveModal.cache = new Map();

            liveModal.bind(selector);
        });
    },

    bind : function (selector)
    {
        $(`[${selector}]`).on('click', function(e)
        {
            e.preventDefault();
            e.stopPropagation();

            let key = $(this).attr(`${selector}`);

            const modal = LiveModalLibraryData[ key ];

            liveModal.query(modal);
        });
    },

    renderModal : function(modal, response)
    {
        let container = (modal.container !== undefined && modal.container !== null) ? modal.container : null;

        if (container)
        {
            let modalWrapperElement = $(`#${container}`);

            modalWrapperElement.find('.modal-body').html(response);

            if (modal.title !== undefined ) modalWrapperElement.find('.modal-title').text(modal.title);

            modalWrapperElement.modal('show');

        } else {
            console.error('Modal container not defined.');
        }
    },

    query : function (modal)
    {
        let handler = LiveModalLibraryHandlers[modal.request_id] ?? null;
        let key = `${modal.endpoint} ${modal.method} ${modal.data}`;
        let cacheStatus = modal.cache !== undefined && modal.cache === true;
        let container = ( modal.container !== undefined && modal.container !== null ) ? modal.container : null;

        if ( cacheStatus )
        {
            if ( !handler && liveModal.cache.has(key) )
            {
                if (container)
                {
                    liveModal.renderModal( modal, liveModal.cache.get(key) );
                }
                return;
            }
        }

        const AJAX = {
            url : modal.endpoint,
            type : modal.method ?? 'GET',
            dataType : modal.dataType ?? 'html',
            data : modal.data ?? {},
            success : function(response)
            {
                if ( handler )
                {
                    handler(response);

                } else if (container) {

                    liveModal.renderModal(modal, response);
                }
            },
            error : function(response)
            {
                console.log(response);
            }
        };

        $.ajax(AJAX).then(response => {
            if ( cacheStatus ) liveModal.cache.set(key, response);
        });
    }
};

liveModal.init(liveModal.selector);