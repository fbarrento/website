import React from 'react';
import { Link } from '@inertiajs/react';

export default function PublicLayout({ children, ...props }: { children: React.ReactNode; }) {
    return (
        <div className="flex flex-col min-h-screen">
            <header className="w-full flex md:items-center flex-col md:flex-row justify-between py-6 max-w-4xl mx-auto px-4 sm:px-6 md:px-8">
                <Link href="/" className="text-xl font-semibold">Francisco Barrento</Link>
                <nav className="">
                    <ul className="flex items-center md:justify-end space-x-4 text-sm underline">
                        <li>
                            <Link href="/" className="flex items-center justify-center">
                                About
                            </Link>
                        </li>
                        <li>
                            <Link href="/articles" className="flex items-center justify-center">
                                Articles
                            </Link>
                        </li>
                        <li>
                            <Link href="/" className="flex items-center justify-center">
                                Projects
                            </Link>
                        </li>
                    </ul>
                </nav>
            </header>
            <main className="flex flex-1 flex-col w-full max-w-4xl mx-auto px-4 sm:px-6 md:px-8 mt-12" {...props}>
                {children}
            </main>
        </div>
    );
}
