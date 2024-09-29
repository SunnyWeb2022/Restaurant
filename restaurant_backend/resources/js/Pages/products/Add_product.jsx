import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';

export default function Add_product({ auth }) {

    const { data, setData, post, processing, errors } = useForm({
        title: '',
        description: '',
        image: null,
        price: '',
    });

    const submit = (e) => {
        e.preventDefault();
        // console.log(data);s

        const formData = new FormData();
        formData.append('title', data.title);
        formData.append('description', data.description);
        formData.append('image', data.image);  // Appending file
        formData.append('price', data.price);

        // Post formData instead of data
        post(route('store_product'), formData);


    };


    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Add Product</h2>}
        >
            <Head title="Add Product" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <form onSubmit={submit}  enctype="multipart/form-data">
                        <div>
                            <InputLabel htmlFor="product_name" value="Product Name" />

                            <TextInput
                                id="product_name"
                                name="title"
                                value={data.title}
                                className="mt-1 block w-full"
                                isFocused={true}
                                onChange={(e) => setData('title', e.target.value)}
                                required
                            />

                            <InputError message={errors.title} className="mt-2" />
                        </div>

                        <div className="mt-4">
                            <InputLabel htmlFor="description" value="Description" />

                            <textarea
                                id="description"
                                name="description"
                                value={data.description}
                                className="mt-1 block w-full"
                                onChange={(e) => setData('description', e.target.value)}
                                required
                            ></textarea>

                            <InputError message={errors.description} className="mt-2" />
                        </div>

                        <div className="mt-4">
                            <InputLabel htmlFor="product_image" value="Product Image" />

                            <TextInput
                                id="product_image"
                                type="file"
                                name="image"
                                // value={data.image}
                                className="mt-1 block w-full"
                                onChange={(e) => setData('image', e.target.files[0])}  
                                required
                            />

                            <InputError message={errors.image} className="mt-2" />
                        </div>

                        <div className="mt-4">
                            <InputLabel htmlFor="product_price" value="Product Price" />

                            <TextInput
                                id="product_price"
                                type="number"
                                name="price"
                                value={data.price}
                                className="mt-1 block w-full"
                                onChange={(e) => setData('price', e.target.value)}
                                required
                            />

                            <InputError message={errors.price} className="mt-2" />
                        </div>

                        <div className="flex items-center justify-end mt-4">

                            <PrimaryButton className="ms-4" disabled={processing}>
                                Submit
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>


        </AuthenticatedLayout>
    );
}
