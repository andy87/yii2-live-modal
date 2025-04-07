
/**
 * yii2\frontend\assets\blocks::LiveDataModalAsset()
 */
const LiveModalLibraryData = window.liveModalLibraryData || {
    action : {
        request_id :"modalContainerView",
        container :"modalContainerView",
        endpoint : " /api/modal/get-html-view",
        id : null,
        model : "design",
        type :  "view"
    }
};
const LiveModalLibraryHandlers = window.liveModalLibraryHandlers || {};


window.addEventListener('load',function ()
{
    const cache = new Map();

    const selector = 'data-live-modal';

    $(`[${selector}]`).on('click', function(e)
    {
        e.preventDefault();
        e.stopPropagation();

        let key = $(this).attr(`${selector}`);

        const modal = LiveModalLibraryData[ key ];

        let renderModal = function (container, response ){
            const modalWrapperElement = $(`#${container}`);

            modalWrapperElement.find('.modal-body').html(response);

            modalWrapperElement.modal('show');
        }

        let handler = LiveModalLibraryHandlers[modal.request_id] ?? null;

        if ( modal.cache !== undefined && !handler )
        {
            key = `${modal.endpoint} ${modal.method} ${modal.data}`;

            if (cache.has(key) ) {
                if (modal.container !== null) {
                    renderModal(modal.container, cache.get(key));
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

                } else if (modal.container !== null) {

                    renderModal(modal.container, response);
                }
            },
            error : function(response)
            {
                console.log(response);
            }
        };

        console.log(AJAX);

        $.ajax(AJAX).then(response => cache.set(key, response));
    });
});