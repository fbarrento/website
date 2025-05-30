import PublicLayout from '@/layouts/public-layout';

interface PageProps {
    title: string;
    html: string;
}

export default function Page({ title, html }: PageProps) {
    return (
        <PublicLayout>
            <h1 className="mb-10 text-3xl font-bold">{title}</h1>
            <div className="prose" dangerouslySetInnerHTML={{ __html: html }}></div>
        </PublicLayout>
    );
}
