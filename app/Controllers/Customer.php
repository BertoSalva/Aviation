<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\RepresentativeModel;
use CodeIgniter\Controller;

class Customer extends Controller
{
    public function index()
    {
        $customerModel = new CustomerModel();
        $representativeModel = new RepresentativeModel();
    
        $customers = $customerModel->findAll();
    
        foreach ($customers as &$customer) {
            $customer['representatives'] = $representativeModel->where('customer_id', $customer['id'])->findAll();
        }
    
        $data['customers'] = $customers;
        return view('customers/index', $data);
    }

    public function create()
    {
        return view('customers/create');
    }

    public function store()
    {
        $customerModel = new CustomerModel();
        $representativeModel = new RepresentativeModel();

        $customerData = [
            'name'    => $this->request->getPost('name'),
            'phone'   => $this->request->getPost('phone'),
            'email'   => $this->request->getPost('email'),
            'address' => $this->request->getPost('address'),
        ];

        $customerId = $customerModel->insert($customerData);

        $representatives = $this->request->getPost('representatives');
        foreach ($representatives as $rep) {
            if (!empty($rep['name']) && !empty($rep['surname'])) {
                $representativeModel->insert([
                    'customer_id' => $customerId,
                    'name'        => $rep['name'],
                    'surname'     => $rep['surname'],
                    'phone'       => $rep['phone'],
                    'email'       => $rep['email'],
                ]);
            }
        }

        return redirect()->to('/customers')->with('success', 'Customer added successfully.');
    }

    public function edit($id)
    {
        $model = new CustomerModel();
        $data['customer'] = $model->find($id);
        $representativeModel = new RepresentativeModel();
        $data['customer']['representatives'] = $representativeModel->where('customer_id', $id)->findAll();

        return view('customers/edit', $data);
    }

    public function update($id)
    {
        $model = new CustomerModel();
        $representativeModel = new RepresentativeModel();

        $customerData = [
            'name'    => $this->request->getPost('name'),
            'phone'   => $this->request->getPost('phone'),
            'email'   => $this->request->getPost('email'),
            'address' => $this->request->getPost('address'),
        ];

        $model->update($id, $customerData);

        $representativeModel->where('customer_id', $id)->delete();

        $representatives = $this->request->getPost('representatives');
        foreach ($representatives as $rep) {
            if (!empty($rep['name']) && !empty($rep['surname'])) {
                $representativeModel->insert([
                    'customer_id' => $id,
                    'name'        => $rep['name'],
                    'surname'     => $rep['surname'],
                    'phone'       => $rep['phone'],
                    'email'       => $rep['email'],
                ]);
            }
        }

        return redirect()->to('/customers')->with('success', 'Customer updated successfully.');
    }

    public function delete($id)
    {
        $model = new CustomerModel();
        $representativeModel = new RepresentativeModel();

        $representativeModel->where('customer_id', $id)->delete();
        $model->delete($id);

        return redirect()->to('/customers')->with('success', 'Customer deleted successfully.');
    }
}
