import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import DangerButton from '@/Components/DangerButton';
import { Head, useForm, usePage } from '@inertiajs/react';
import PrimaryButton from '@/Components/PrimaryButton';
import { Inertia } from '@inertiajs/inertia';


export default function Show_product({ auth }) {

    const Table_head = ['Sl.No','Title','Image','Price','Action']
    const classes ="p-4 border-b border-blue-gray-50 text-center";

    const products = usePage().props.product;
    
    const {post} = useForm();
  
    const handleEdit = (id) => {
        Inertia.post(route('edit_product'),{id});  
    }

    const handledelete = (id) => {
        Inertia.post(route('delete_product'),{id});  
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Show Product</h2>}
        >
            <Head title="Show Product" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <table className="w-full min-w-max table-auto text-left">
                        <thead>
                            <tr>
                                {Table_head.map(( head ) => (
                                        <th key={head} className='border-b border-blue-gray-100 bg-blue-gray-50 p-4 text-center'>
                                            {head}
                                        </th>
                                ))}
                                
                            </tr>
                        </thead>
                        <tbody>
                                {products.map((product,index) =>(
                                    <tr key={product}>
                                        <td className={classes}>{++index}</td>
                                        <td className={classes}>{product.title}</td>
                                        {/* <td className={classes}>{product.description}</td> */}
                                        <td className={classes}><img src={`http://127.0.0.1:8000/images/products/${product.image}`} width={50}  alt="product image"/></td>
                                        <td className={classes}>{product.price}</td>
                                        <td className={classes} >
                                             <PrimaryButton
                                              className='mx-4'
                                              onClick={() => handleEdit(product.id)}>
                                                 Edit
                                             </PrimaryButton>
                                            
                                            <DangerButton onClick={() => handledelete(product.id)}>
                                                Delete
                                            </DangerButton>
                                        </td>
                                    </tr>
                                ))}
                        </tbody>
                    </table>
                </div>
            </div>


        </AuthenticatedLayout>
    );
}
