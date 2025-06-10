<?php

namespace App\Controllers;

use App\Models\MemberModel;
use CodeIgniter\Controller;

 class MemberController extends BaseController {

    public function index (): string
    {
        $model = new MemberModel();
//        $data['members'] = $model->findAll();
        $data['members'] = $model->paginate(10);
        $data['pager']   = $model->pager;
        return view('members/index', $data);
    }

    public function edit ($id): string
    {
        $model = new MemberModel();
        $data['member'] = $model->find($id);
        return view ('members/edit', $data);
    }

     /**
      * @throws \ReflectionException
      */
     public function update($id): \CodeIgniter\HTTP\RedirectResponse
     {
         $model = new MemberModel();

         $data = [
             'first_name'        => $this->request->getPost('first_name'),
             'surname'           => $this->request->getPost('surname'),
             'email'             => $this->request->getPost('email'),
             'phone'             => $this->request->getPost('phone'),
             'role'              => $this->request->getPost('role'),
             'class_attended'    => $this->request->getPost('class_attended'),
         ];

         $model->update($id, $data);

         // Log data to debug if needed
         log_message('debug', 'Updating member id=' . $id . ' with data: ' . print_r($data, true));

         return redirect()->to('/members')->with('success', 'Member updated successfully');
     }

    public function delete ($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $model = new MemberModel();
        $model->delete($id);
        return redirect()->to('/members')->with('success', 'Member deleted successfully');
    }

    public function create (): string
    {
        return view('members/create');
    }

     /**
      * @throws \ReflectionException
      */
     public function store () : \CodeIgniter\HTTP\RedirectResponse
     {
        $model = new MemberModel();
        $model = $model->save($this->request->getPost());
        return redirect()->to('members');
    }

     public function search(): \CodeIgniter\HTTP\ResponseInterface
     {
         $term = $this->request->getGet('term');
         $model = new MemberModel();

         $results = $model->like('first_name', $term)
             ->orLike('surname', $term)
             ->orLike('membership_number', $term)
             ->findAll(10); // limit results for performance

         $data = [];

         foreach ($results as $member) {
             $data[] = [
                 'id'   => $member['id'],
                 'label' => $member['first_name'] . ' ' . $member['surname'] . ' (' . $member['membership_number'] . ')',
                 'value' => $member['first_name'] . ' ' . $member['surname'],
             ];
         }

         return $this->response->setJSON($data);
     }


 }