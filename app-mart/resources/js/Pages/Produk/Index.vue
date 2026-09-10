import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Index({ auth, produks }) {
    const { delete: destroy } = useForm();

    const handleDelete = (id) => {
        if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
            destroy(route('produk.destroy', id));
        }
    };

    return (
        <AuthenticatedLayout user={auth.user} header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Data Produk</h2>}>
            <Head title="Data Produk" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <Link href={route('produk.create')} className="bg-blue-500 text-white px-4 py-2 rounded-md mb-4 inline-block">
                            Tambah Produk
                        </Link>
                        <table className="min-w-full divide-y divide-gray-200 mt-4">
                            <thead>
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody className="bg-white divide-y divide-gray-200">
                                {produks.map((p) => (
                                    <tr key={p.id}>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <img src={`/storage/${p.foto}`} alt={p.nama_produk} className="w-16 h-16 object-cover rounded" />
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">{p.nama_produk}</td>
                                        <td className="px-6 py-4 whitespace-nowrap">Rp {p.harga}</td>
                                        <td className="px-6 py-4 whitespace-nowrap">{p.stok}</td>
                                        <td className="px-6 py-4 whitespace-nowrap space-x-2">
                                            <Link href={route('produk.edit', p.id)} className="text-yellow-600">Edit</Link>
                                            <button onClick={() => handleDelete(p.id)} className="text-red-600">Hapus</button>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}