import { useState } from 'react';
import './App.css';
import { Listbox } from '@headlessui/react'



const people = [
  { id: 1, name: 'Durward Reynolds', unavailable: false },
  { id: 2, name: 'Kenton Towne', unavailable: false },
  { id: 3, name: 'Therese Wunsch', unavailable: false },
  { id: 4, name: 'Benedict Kessler', unavailable: true },
  { id: 5, name: 'Katelyn Rohan', unavailable: false },
]


export default function App() {
  const [selectedPerson, setSelectedPerson] = useState(people[0])


  return (
    <div className="container mx-auto">
      <div className="flex justify-center h-screen items-center">
        <h1 className="text-xl font-bold ">
          AvoRed React E commerce {' '}
          <span className="text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-blue-500 to-purple-600">
            Switch (Toggle)
          </span>
        </h1>
        <Listbox value={selectedPerson} onChange={setSelectedPerson}>
          <Listbox.Button>{selectedPerson.name}</Listbox.Button>
          <Listbox.Options>
            {people.map((person) => (
              <Listbox.Option
                key={person.id}
                value={person}
                disabled={person.unavailable}
              >
                {person.name}
              </Listbox.Option>
            ))}
          </Listbox.Options>
        </Listbox>

      </div>
    </div>
  )
}
