import { Dialog, Transition } from '@headlessui/react'
import { XMarkIcon } from '@heroicons/react/24/solid'
import { Fragment, useState } from 'react'
import { FlashMessageState, lastFlashMessage, removeLast } from '../../features/flash/flashSlice';
import { useAppDispatch, useAppSelector } from '../../app/hooks';
import { isEmpty } from 'lodash';

export function FlashMessage() {

    const flashMessage: FlashMessageState | undefined = useAppSelector(lastFlashMessage);
    const dispatch = useAppDispatch();
    
    let [isOpen, setIsOpen] = useState(true)

    function closeModal() {
        dispatch(removeLast())
        setIsOpen(false)
    }

    return (
        <>
            {!isEmpty(flashMessage) ? 
                <Transition appear show={isOpen} as={Fragment}>
                    <Dialog as="div" className="z-10" onClose={closeModal}>
                    <Transition.Child
                        as={Fragment}
                        enter="ease-out duration-300"
                        enterFrom="opacity-0"
                        enterTo="opacity-100"
                        leave="ease-in duration-200"
                        leaveFrom="opacity-100"
                        leaveTo="opacity-0"
                    >
                        <div className="fixed inset-0 bg-black bg-opacity-25" />
                    </Transition.Child>

                    <div className="fixed right-10 bottom-10 overflow-y-auto">
                        <div className="flex min-h-full items-center justify-center p-4 text-center">
                        <Transition.Child
                            as={Fragment}
                            enter="ease-out duration-300"
                            enterFrom="opacity-0 scale-95"
                            enterTo="opacity-100 scale-100"
                            leave="ease-in duration-200"
                            leaveFrom="opacity-100 scale-100"
                            leaveTo="opacity-0 scale-95"
                        >
                            <Dialog.Panel className="w-full bg-green-100  max-w-md transform overflow-hidden rounded-2xl p-6 text-left align-middle shadow-xl transition-all">
                            <div className="flex justify-center items-center text-green-600">
                                <div className="text-sm mr-5">
                                    {flashMessage.message}
                                </div>
                                <div className="ml-auto">
                                    <XMarkIcon onClick={closeModal} className='w-5 h-5 opacity-50' />
                                </div>
                            </div>
                            </Dialog.Panel>
                        </Transition.Child>
                        </div>
                    </div>
                    </Dialog>
                </Transition>
                : ''
            }
        </>
    )
}
