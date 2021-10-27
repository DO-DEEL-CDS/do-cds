<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} API</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *, :after, :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg, video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns:repeat(1, minmax(0, 1fr))
        }

        @media (min-width: 640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width: 768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns:repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width: 1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme: dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: #6b7280;
                color: rgba(107, 114, 128, var(--tw-text-opacity))
            }
        }

        }
    </style>

    <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
    </style>
</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">


    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <svg width="91" height="20" viewBox="0 0 91 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.388 0.799999H14.742V19H11.388V17.466C10.4 18.7313 8.996 19.364 7.176 19.364C5.42533 19.364 3.926 18.7053 2.678 17.388C1.44733 16.0533 0.832 14.424 0.832 12.5C0.832 10.576 1.44733 8.95533 2.678 7.638C3.926 6.30333 5.42533 5.636 7.176 5.636C8.996 5.636 10.4 6.26867 11.388 7.534V0.799999ZM5.2 15.152C5.89333 15.828 6.76 16.166 7.8 16.166C8.84 16.166 9.698 15.828 10.374 15.152C11.05 14.4587 11.388 13.5747 11.388 12.5C11.388 11.4253 11.05 10.55 10.374 9.874C9.698 9.18067 8.84 8.834 7.8 8.834C6.76 8.834 5.89333 9.18067 5.2 9.874C4.524 10.55 4.186 11.4253 4.186 12.5C4.186 13.5747 4.524 14.4587 5.2 15.152ZM28.8854 17.388C27.5507 18.7053 25.9214 19.364 23.9974 19.364C22.0734 19.364 20.4441 18.7053 19.1094 17.388C17.7921 16.0533 17.1334 14.424 17.1334 12.5C17.1334 10.576 17.7921 8.95533 19.1094 7.638C20.4441 6.30333 22.0734 5.636 23.9974 5.636C25.9214 5.636 27.5507 6.30333 28.8854 7.638C30.2201 8.95533 30.8874 10.576 30.8874 12.5C30.8874 14.424 30.2201 16.0533 28.8854 17.388ZM21.4754 15.074C22.1514 15.75 22.9921 16.088 23.9974 16.088C25.0027 16.088 25.8434 15.75 26.5194 15.074C27.1954 14.398 27.5334 13.54 27.5334 12.5C27.5334 11.46 27.1954 10.602 26.5194 9.926C25.8434 9.25 25.0027 8.912 23.9974 8.912C22.9921 8.912 22.1514 9.25 21.4754 9.926C20.8167 10.602 20.4874 11.46 20.4874 12.5C20.4874 13.54 20.8167 14.398 21.4754 15.074ZM43.1009 0.799999H46.4549V19H43.1009V17.466C42.1129 18.7313 40.7089 19.364 38.8889 19.364C37.1382 19.364 35.6389 18.7053 34.3909 17.388C33.1602 16.0533 32.5449 14.424 32.5449 12.5C32.5449 10.576 33.1602 8.95533 34.3909 7.638C35.6389 6.30333 37.1382 5.636 38.8889 5.636C40.7089 5.636 42.1129 6.26867 43.1009 7.534V0.799999ZM36.9129 15.152C37.6062 15.828 38.4729 16.166 39.5129 16.166C40.5529 16.166 41.4109 15.828 42.0869 15.152C42.7629 14.4587 43.1009 13.5747 43.1009 12.5C43.1009 11.4253 42.7629 10.55 42.0869 9.874C41.4109 9.18067 40.5529 8.834 39.5129 8.834C38.4729 8.834 37.6062 9.18067 36.9129 9.874C36.2369 10.55 35.8989 11.4253 35.8989 12.5C35.8989 13.5747 36.2369 14.4587 36.9129 15.152ZM52.3563 13.878C52.8069 15.5073 54.0289 16.322 56.0223 16.322C57.3049 16.322 58.2756 15.8887 58.9343 15.022L61.6383 16.582C60.3556 18.4367 58.4663 19.364 55.9703 19.364C53.8209 19.364 52.0963 18.714 50.7963 17.414C49.4963 16.114 48.8463 14.476 48.8463 12.5C48.8463 10.5413 49.4876 8.912 50.7703 7.612C52.0529 6.29467 53.6996 5.636 55.7103 5.636C57.6169 5.636 59.1856 6.29467 60.4163 7.612C61.6643 8.92933 62.2883 10.5587 62.2883 12.5C62.2883 12.9333 62.2449 13.3927 62.1583 13.878H52.3563ZM52.3043 11.278H58.9343C58.7436 10.394 58.3449 9.73533 57.7383 9.302C57.1489 8.86867 56.4729 8.652 55.7103 8.652C54.8089 8.652 54.0636 8.886 53.4743 9.354C52.8849 9.80467 52.4949 10.446 52.3043 11.278ZM67.3621 13.878C67.8128 15.5073 69.0348 16.322 71.0281 16.322C72.3108 16.322 73.2815 15.8887 73.9401 15.022L76.6441 16.582C75.3615 18.4367 73.4721 19.364 70.9761 19.364C68.8268 19.364 67.1021 18.714 65.8021 17.414C64.5021 16.114 63.8521 14.476 63.8521 12.5C63.8521 10.5413 64.4935 8.912 65.7761 7.612C67.0588 6.29467 68.7055 5.636 70.7161 5.636C72.6228 5.636 74.1915 6.29467 75.4221 7.612C76.6701 8.92933 77.2941 10.5587 77.2941 12.5C77.2941 12.9333 77.2508 13.3927 77.1641 13.878H67.3621ZM67.3101 11.278H73.9401C73.7495 10.394 73.3508 9.73533 72.7441 9.302C72.1548 8.86867 71.4788 8.652 70.7161 8.652C69.8148 8.652 69.0695 8.886 68.4801 9.354C67.8908 9.80467 67.5008 10.446 67.3101 11.278ZM79.6356 19V0.0199995H82.9896V19H79.6356ZM89.5694 18.688C89.1361 19.1213 88.6161 19.338 88.0094 19.338C87.4027 19.338 86.8827 19.1213 86.4494 18.688C86.0161 18.2547 85.7994 17.7347 85.7994 17.128C85.7994 16.5213 86.0161 16.0013 86.4494 15.568C86.8827 15.1347 87.4027 14.918 88.0094 14.918C88.6161 14.918 89.1361 15.1347 89.5694 15.568C90.0027 16.0013 90.2194 16.5213 90.2194 17.128C90.2194 17.7347 90.0027 18.2547 89.5694 18.688Z"
                      fill="#29A439"/>
            </svg>
        </div>
    </div>
</div>
</div>
</body>
</html>
