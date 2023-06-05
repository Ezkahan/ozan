<?php


namespace Webkul\CMS\Http\Controllers\Admin;


use Webkul\CMS\Http\Controllers\Controller;
use Webkul\CMS\Repositories\MessageRepository;

class MessageController  extends Controller
{
    /**
     * To hold the request variables from route file
     *
     * @var array
     */
    protected $_config;

    /**
     * To hold the CMSRepository instance
     *
     * @var \Webkul\CMS\Repositories\MessageRepository
     */
    protected $messageRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\CMS\Repositories\MessageRepository  $messageRepository
     * @return void
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->middleware('admin');

        $this->messageRepository = $messageRepository;

        $this->_config = request('_config');
    }

    /**
     * Loads the index page showing the static pages resources
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->_config['view']);
    }
    /**
     * Show the view for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $message= $this->messageRepository->findOrFail(2);
        return view($this->_config['view'], compact('message'));
    }

    /**
     * To delete the previously create CMS page
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $message = $this->messageRepository->findOrFail($id);

        if ($message->delete()) {
            session()->flash('success', trans('admin::app.cms.messages.delete-success'));

            return response()->json(['message' => true], 200);
        } else {
            session()->flash('success', trans('admin::app.cms.messages.delete-failure'));

            return response()->json(['message' => false], 200);
        }
    }
    /**
     * To mass delete the CMS resource from storage
     *
     * @return \Illuminate\Http\Response
     */
    public function massDelete()
    {
        $data = request()->all();

        if ($data['indexes']) {
            $pageIDs = explode(',', $data['indexes']);

            $count = 0;

            foreach ($pageIDs as $pageId) {
                $page = $this->messageRepository->find($pageId);

                if ($page) {
                    $page->delete();

                    $count++;
                }
            }

            if (count($pageIDs) == $count) {
                session()->flash('success', trans('admin::app.datagrid.mass-ops.delete-success', [
                    'resource' => 'Messages',
                ]));
            } else {
                session()->flash('success', trans('admin::app.datagrid.mass-ops.partial-action', [
                    'resource' => 'Messages',
                ]));
            }
        } else {
            session()->flash('warning', trans('admin::app.datagrid.mass-ops.no-resource'));
        }

        return redirect()->route('admin.cms.message');
    }
}
