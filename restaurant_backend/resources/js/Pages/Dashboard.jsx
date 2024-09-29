import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { Link } from 'react-router-dom';


import Add_product from './products/Add_product';

export default function Dashboard({ auth }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12 w-1/4">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <a href="/Add_product" className="p-10 text-gray-900">Add Product</a>                       
                    </div>
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg my-4">
                        <a href="/Show_product" className="p-10 text-gray-900">Show Product</a>                       
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
