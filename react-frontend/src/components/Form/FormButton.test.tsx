import { render, fireEvent, screen } from "@testing-library/react";
import { FormButton } from "./FormButton";

test("testing form button type attribute", () => {
    render(
        <FormButton type="submit">
            Test Button
        </FormButton>    
    );
    expect(screen.getByRole('button').getAttribute('type')).toContain('submit')
});

test("testing form button component in the document", () => {
    render(
        <FormButton type="submit">
            Test Button
        </FormButton>    
    );
    expect(screen.getByRole('button')).toBeInTheDocument()
});
